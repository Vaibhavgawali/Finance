$(document).ready(function () {
    let files = [];
    let progressBar = $("#progress-bar");
    let button = $(".fileButton");
    let form = $("#loanForm");
    let container = $(".containerDiv");
    let text = $(".innerDiv");
    let imageDiv = $(".imageDiv");
    let toggleText = $(".toggleText");
    let browse = $(".selectDiv");
    let input = $(".file");
    let dragoverDiv = $(".dragover");
    let count = $("#count");

    // Initially disable file input
    input.prop("disabled", true);

    window.toggleBrowse = () => {
        $(".file").click();
    };

    const updateToggleText = () => {
        let documents_name = $("#documents_name").val();
        if (documents_name == null || documents_name === "") {
            toggleText.html("Please Select Documents");
            // Disable file input if document option is not selected
            input.prop("disabled", true);
        } else {
            toggleText.html(
                '<span class="innerDiv">Drag & drop image here or <span class="selectDiv text-[#5256ad] ml-[7px] cursor-pointer " onclick="toggleBrowse()">Browse </span></span>'
            );
            // Enable file input if document option is selected
            input.prop("disabled", false);
        }
    };

    // Call updateToggleText initially
    updateToggleText();

    // Event listener for select element change
    $("#documents_name").on("change", updateToggleText);

    // Input change Event
    input.on("change", function (event) {
        let fileInput = event.target;
        let fileList = fileInput.files;
        let selectedOption = $("#documents_name").val();

        if (selectedOption == null || selectedOption === "") {
            swal({
                title: "Oops!",
                text: "Please select a document option first!",
                icon: "warning",
                button: "OK",
            });
            return;
        }

        handleFiles(fileList, selectedOption);

        form.trigger("reset");
        showImages();
    });

    // Drag events for the dragover div
    dragoverDiv.on("dragenter", function (event) {
        event.preventDefault();
        event.stopPropagation();
        dragoverDiv.addClass("dragging");
    });

    dragoverDiv.on("dragover", function (event) {
        event.preventDefault();
        event.stopPropagation();
    });

    dragoverDiv.on("dragleave", function (event) {
        event.preventDefault();
        event.stopPropagation();
        dragoverDiv.removeClass("dragging");
    });

    dragoverDiv.on("drop", function (event) {
        event.preventDefault();
        event.stopPropagation();
        dragoverDiv.removeClass("dragging");

        let fileList = event.originalEvent.dataTransfer.files;
        let selectedOption = $("#documents_name").val();

        if (selectedOption == null || selectedOption === "") {
            swal({
                title: "Oops!",
                text: "Please select a document option first!",
                icon: "warning",
                button: "OK",
            });
            return;
        }

        handleFiles(fileList, selectedOption);

        form.trigger("reset");
        showImages();
    });

    const handleFiles = (fileList, selectedOption) => {
        for (let i = 0; i < fileList.length; i++) {
            let file = fileList[i];
            let fileSizeKB = file.size / 1024; // Calculate file size in KB
            let fileType = file.type.split("/")[1]; // Get the file type

            // Check file size
            if (fileSizeKB > 100) {
                swal({
                    title: "Oops!",
                    text: "File size should be less than 100 KB!",
                    icon: "warning",
                    button: "OK",
                });
                continue; // Skip this file
            }

            // Check file type
            if (!["png", "jpg", "jpeg", "pdf"].includes(fileType)) {
                swal({
                    title: "Oops!",
                    text: "Only PNG, JPG, JPEG, and PDF files are allowed!",
                    icon: "warning",
                    button: "OK",
                });
                continue; // Skip this file
            }

            let duplicateFile = false;
            let duplicateOption = false;

            for (let j = 0; j < files.length; j++) {
                if (files[j].file.name === file.name) {
                    duplicateFile = true;
                    break;
                }

                if (files[j].option === selectedOption) {
                    duplicateOption = true;
                    break;
                }
            }

            if (duplicateFile) {
                swal({
                    title: "Oops!",
                    text: "File already exists!",
                    icon: "warning",
                    button: "OK",
                });
            } else if (duplicateOption) {
                swal({
                    title: "Oops!",
                    text: "Option already in use!",
                    icon: "warning",
                    button: "OK",
                });
            } else {
                files.push({
                    file: file,
                    option: selectedOption,
                });

                // Update progress bar
                updateProgressBar();
            }
        }
    };

    const showImages = () => {
        let images = "";
        files.forEach((e, i) => {
            images += `<div class="imageDiv h-[85px] w-[85px] rounded-[5px] shadow-sm overflow-hidden relative mb-2 mr-2 ">
                       <img src="${URL.createObjectURL(
                           e.file
                       )}" alt="" class="h-full w-full ">
                       <span class="  absolute top-[-4px] right-[5px] cursor-pointer text-sm text-white hover:opacity-[0.8]" onclick="deleteImage(${i})">X</span>
                   </div>`;
        });
        container.html(images);
    };

    const updateProgressBar = () => {
        let progressStep = 100 / 12; // Assuming 2 options
        let totalSteps = files.length * progressStep;
        let currentProgress =
            totalSteps > 0 ? Math.floor((100 * files.length) / 12) : 0; // Initial progress calculation

        // Smoothly update the progress bar width
        progressBar.animate({ width: currentProgress + "%" }, 2000);

        // Smoothly update the percentage count
        $({ countNum: count.text().replace("%", "") }).animate(
            { countNum: currentProgress },
            {
                duration: 2000,
                step: function () {
                    count.text(Math.floor(this.countNum) + "%");
                },
                complete: function () {
                    count.text(this.countNum + "%");
                },
            }
        );
        // Change background color based on percentage
        if (currentProgress < 25) {
            progressBar.css("background-color", "red");
        } else if (currentProgress >= 25 && currentProgress < 40) {
            progressBar.css("background-color", "yellow");
        } else if (currentProgress >= 40 && currentProgress < 50) {
            progressBar.css("background-color", "blue");
        } else if (currentProgress >= 50 && currentProgress < 75) {
            progressBar.css("background-color", "lightgreen");
        } else if (currentProgress >= 75 && currentProgress < 90) {
            progressBar.css("background-color", "green");
        }
    };

    // Define deleteImage function in the global scope
    window.deleteImage = async (i) => {
        if (i >= 0 && i < files.length) {
            files.splice(i, 1);
            showImages(); // Update the displayed images after deletion
            updateProgressBar(); // Update progress bar after deletion
        } else {
            console.error("Index out of bounds or invalid:", i);
        }
    };

    $("#imageForm").on("submit", function (e) {
        if (files.length === 0) {
            swal({
                title: "Oops!",
                text: "Please select files to upload!",
                icon: "warning",
                button: "OK",
            });
            event.preventDefault(); // Prevent the form from submitting
        }
        e.preventDefault();
        console.log(files);
        // Your AJAX code here
    });
});
