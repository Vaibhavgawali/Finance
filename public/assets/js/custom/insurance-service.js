$(document).ready(function () {
  
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return false;
})
  function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return "";
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  }

  // Get the insurance plan from the URL
  var insurancePlan = getParameterByName("plan");

  // Store the insurance plan value in a JavaScript variable
  var storedInsurancePlan = insurancePlan;
  console.log(storedInsurancePlan);

  // Display the insurance plan title on the page
  var insurancePlanTitleElement = document.getElementById("insurancePlanTitle");
  // insurancePlanTitleElement.textContent = 'Selected Insurance Plan: ' + storedInsurancePlan;

  //Form Submission of health insurance plans

  $("#health_insurance_form").submit((e) => {
    e.preventDefault();
    // Getting the form values
    let name = $("#name").val();
    let phone = $("#phone").val();
    let insurance_plan = $("#insurance_plan").val();
    let age = $("#age").val();
    let existing_plan = $('input[name="existing_plan"]:checked').val();

    //insurance plan info inserting dynamically
    insurance_plan = insurancePlan;

    $("#name_error").html("");
    $("#phone_error").html("");
    $("#age_error").html("");
    $("#existing_plan_error").html("");

    if (
      name == "" ||
      name == null ||
      name == "undefined" ||
      name == undefined
    ) {
      $("#name_error").html(
        '<div class=" invalid-feedback d-block">Name is required.</div>'
      );
      $("#name").focus();
      return false;
    }
    if (
      phone == "" ||
      phone == null ||
      phone == "undefined" ||
      phone == undefined
    ) {
      $("#phone_error").html(
        '<div class=" invalid-feedback d-block">Mobile Number is required.</div>'
      );
      $("#phone").focus();
      return false;
    }
    if (age == "" || age == null || age == "undefined" || age == undefined) {
      $("#age_error").html(
        '<div class=" invalid-feedback d-block">Age is required.</div>'
      );
      $("#age").focus();
      return false;
    }
    if (
      existing_plan == "" ||
      existing_plan == null ||
      existing_plan == "undefined" ||
      existing_plan == undefined
    ) {
      $("#existing_plan_error").html(
        '<div class=" invalid-feedback d-block">Existing Plan is required.</div>'
      );
      $("input[name='existing_plan']").focus();
      return false;
    }

    let data = {
      name: name,
      phone: phone,
      insurance_plan: insurance_plan,
      age: age,
      existing_plan: existing_plan,
    };
    swal({
      title: "Good job!",
      text: "You clicked the button!",
      icon: "success",
    });
  });

  const insuranceData = [
    {
      title: "Individual Health Insurance",
      heading: "Individual Health Insurance Plans at Blarkafin",
      description: [
        {
          paragraph:
            "Embark on a journey of well-being with Blarkafin's Individual Health Insurance, crafted to empower your health and secure your future.",
        },
      ],

      servicebox: [
        {
          title: "Lower Health Insurance Premium",
          image: "https://www.blarkafin.com/images/first-img.png",
        },
        {
          title: "Suitable for the Elderly",
          image: "https://www.blarkafin.com/images/second-img.png",
        },
        {
          title: "Ability to Avail Bigger Discounts",
          image: "https://www.blarkafin.com/images/third-img.png",
        },
        {
          title: "Better Tax Savings",
          image: "https://www.blarkafin.com/images/fourth-img.png",
        },
      ],

      middlebox: [
        {
          right_title: "Importance of Health Insurance ?",
          right_description: [
            {
              paragraph: "Care Health Insurance brings you a safety net in the form of its unique health insurance plans They bring you the option to choose insurance coverage to manage unexpected medical expenses that arise from accidents, hospitalisation, etc. Care Health’s uniquely curated Individual Health Insurance plans offer you special benefits, coverages and inclusions based on your plan preferences.",
            },
            {
              paragraph: "Care Health Insurance has plans designed for every individual’s needs. From safeguarding yourself to opting for additional coverage for your family members, you have the option to customise your health insurance based on your personal needs, and economic suitability.",
            },
          ],
          left_title: "Benefits of Health Insurance",
          left_pointer: [
            {
              points: "Annual Health Check-up for all Insured Members",
            },
            {
              points: "Rewards for Your Good Health with No Claim Bonus",
            },
            {
              points: "Tax savings up to INR 75,000",
            },
            {
              points: "Organ Donor Cover",
            },
            {
              points: "Unlimited E-Consultation",
            },
            {
              points: "In Patient & Day Care Treatment Expenses",
            }
          ],
        },
      ],
      bottombox: [
        {
          video_url: "https://www.youtube.com/embed/VczRh7AHHFI",
          broucher_url: "Brouchers/individual-health-insurance.pdf",
          questions: [
            {
              question: "What is beneficial for me - floater insurance or individual insurance?",
              answer: "As a general rule, younger and nuclear families should opt for family floater plans. But if you have specific medical conditions and a complex medical history, you should always choose individual plans for every member.",
            },
            {
              question: "Do I get tax benefits under an individual insurance policy?",
              answer: "Yes, you can avail up to Rs. 25,000/-as tax benefits under the policy.",
            },
            {
              question: "Do I get a cashless hospitalisation facility under individual plans?",
              answer: "Yes, you will get the cashless hospitalisation facility across our 8350+ network hospitals.",
            },
            {
                question:" I am covered in an employee health insurance policy; would I still have to get a health cover?",
                answer:"Yes, given the rising health risks, it is better to have a separate health cover. That’s because employee health policies will cease to provide coverage if you leave or switch jobs and may prove inadequate to cover your major medical expenses."
            }
          ],
        },
      ],
    },
    {
        title: "Family Health Insurance",
        heading: "Comprehensive Coverage for Your Loved Ones by Blarkafin",
        description: [
          {
            paragraph:
              "Experience the tranquility of family well-being with Blarkafin's Family Health Insurance. Tailored protection for the ones you cherish the most.",
          },
        ],
  
        servicebox: [
          {
            title: "Shield Against Healthcare Inflation",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "Protection From Lifestyle Diseases",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "Relief Amid Chronic Illnesses",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Affordable Healthcare & Financial Security",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "Health insurance plans for family provide medical and financial security coverage to the whole family against unexpected hospitalisation and illnesses. Under family health insurance, the policyholder can cover himself, his parents, spouse, dependent children, and elders by paying a common premium.",
              },
              {
                paragraph: "The policy's sum insured acts as a pool of funds for everyone to use. Any insured family member can use the sum insured entirely or partly to pay hospitalisation expenses and other medical costs.",
              },
            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "Avail Annual Health Checkup & Save Tax u/s 80D",
              },
              {
                points: "Coverage for COVID-19 and Alternate treatment",
              },
              {
                points: "Hassle-Free Experience with 95.2% Claim Settlement Ratio",
              },
              {
                points: "Coverage for Modern Treatment like Robotic Surgery, etc",
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/ossWE-OGqRo",
            broucher_url: "Brouchers/family-health-insurance.pdf",
            questions: [
              {
                question: "What is the difference between a family floater and individual health insurance?",
                answer: "A family health plan covers more than one family member in a single policy. This plan is best for young couples or small families with older parents. It covers them all with a common sum insured. Individual health plans are for people who need a policy for one family member, an older person, or someone very sick.",
              },
              {
                question: "What are the benefits of buying health insurance at an early age?",
                answer: "Opting for health insurance at an early age is beneficial in more ways than one. Firstly, policy issuance becomes easy without any pre-policy medical check-ups. Secondly, owing to the early exhaustion of the waiting period, you can get coverage for all treatments at a later age without any delays. Also, you can enjoy tax benefits under section 80D.",
              },
              {
                question: "What is beneficial for me- family cover or individual insurance?",
                answer: "You should prefer a family cover if you have a nuclear family with younger, dependent children. However, if you have older parents, specifically above 60 years of age, you should opt for individual insurance policies for parents.",
              }    
            ]
          },
        ],
    },
    {
        title: "Senior Citizen Health Insurance",
        heading: "Embrace Security with Senior Citizen Health Insurance at Blarkafin",
        description: [
          {
            paragraph:
              "Experience specialized health coverage designed to meet the unique needs of our esteemed seniors. Your well-being, our priority.",
          },
        ],
  
        servicebox: [
          {
            title: "In-Patient Hospitalisation",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "Pre and Post-Hospitalisation",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "Annual Health Check-up",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Daycare Treatments",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "Senior citizen health insurance is a type of insurance that covers the healthcare needs of people over the age of 60. We at Care Health Insurance understand old age is equivalent to relaxed days. However, it also invites worries regarding the health and well-being of older ones.",
              },
              {
                paragraph: "To overcome old age fears, we introduce— 'Care for Senior'—our best-reviewed medical insurance for senior citizens that meets old age-related healthcare and emergency needs with comprehensive coverage of hospitals, treatments, and other medical costs.",
              },
            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "No Pre-Policy Medical Checkup",
              },
              {
                points: "Annual Checkup for all Insured Members",
              },
              {
                points: "540+ Day Care Treatments Cover",
              },
              {
                points: "Save Tax up to ₹ 1,00,000/- U/S 80D",
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/ossWE-OGqRo",
            broucher_url: "Brouchers/senior-citizen-health-insurance.pdf",
            questions: [
              {
                question: "Why is it important to have health insurance for elders and senior citizens?",
                answer: "The Care Senior Health Insurance plan is specially designed for elderly people who are above 60 years. It provides cashless hospitalization, day-care expenses, no claim bonus, coverage for pre-existing diseases, and annual health check-ups. It is also beneficial for retired people to maintain good health without financial stress.",
              },
              {
                question: "Why Medical Insurance Coverage is required for Senior Citizens?",
                answer: "For senior citizens who rely on their pension savings or interest income in order to meet their regular expenses, a medical exigency without the support of health insurance can lead to a financial burden. Besides, health care costs are on the rise in India. Moreover, senior citizens are people who need timely and quality health care the most, owing to age-related illnesses. Opting for Senior Citizen Medical Insurance coverage provides them with a financial cushion and helps them lead a stress-free life.",
              },
              {
                question: "What is the Maximum Age to avail senior citizen mediclaim by CHIL?",
                answer: "There is no upper age limit to avail our senior citizens medical insurance.",
              }    
            ]
          },
        ],
    },
    {
        title: "Maternity Health Insurance",
        heading: "Nurturing Expectant Mothers with Blarkafin's Maternity Health Insurance",
        description: [
          {
            paragraph:
              "Embrace the journey to motherhood with confidence. Blarkafin's Maternity Health Insurance ensures the well-being of both you and your little one.",
          },
        ],
  
        servicebox: [
          {
            title: "Cashless Hospitalization",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "In-patient care",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "Day Care Treatment",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Advance Technology Methods",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "Maternity insurance is a type of health insurance that covers maternity related expenses. Although parenthood is one of the most overwhelming experiences, it comes with additional expenses.",
              },
              {
                paragraph: "A progressive increase in medical expenses and soaring hospitalization charges may create a financial crunch for the couples if they haven’t sought pregnancy insurance in time.",
              },
            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "Perfect Blend of Hospitalization and Maternity Insurance",
              },
              {
                points: "New Born Baby Cover up to 90 Days",
              },
              {
                points: "10% Premium Discount on Multi-Year Policy",
              },
              {
                points: "Coverage to 541 Day Care Treatments",
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/S6THyw66JL4",
            broucher_url: "Brouchers/maternity-health-insurance.pdf",
            questions: [
              {
                question: "What is maternity health insurance and how does it work?",
                answer: "Maternity insurance policy is a type of health insurance that covers maternity expenses related to normal or caesarean delivery along with newborn baby care up to a defined sum insured limit.",
              },
              {
                question: "When should I buy maternity health insurance plan?",
                answer: "You can buy maternity insurance plans when you are ahead to plan a family. Under our insurance for maternity -‘Joy Today’ we cover maternity expenses after 9 months and in the case of another cover called “Joy Tomorrow,” we cover maternity expenses after 2 Years.",
              },
              {
                question: "Can I get maternity health insurance while pregnant?",
                answer: "You can take maternity insurance coverage when you are ready to welcome your bundle of joy. However, the benefit is only available if the delivery happens after the waiting period. So, it is advisable to buy pregnancy insurance coverage as early as possible.",
              }, 
              {
                question: "How do I get health insurance that covers pregnancy for my wife and new-born?",
                answer: "With CHI, you would get pregnancy cover health insurance that covers delivery expenses. Our Joy Maternity Insurance Plan is one of the popular insurance that covers pregnancy related expenses including newborn baby care up to 90 days.",
              }    
            ]
          },
        ],
    },
    {
        title: "Health Insurance for Diabetes",
        heading: "Specialized Diabetes  Insurance Solutions at Blarkafin",
        description: [
          {
            paragraph:
              "Transforming the landscape of health insurance, Blarkafin offers tailored solutions for individuals managing diabetes. Experience comprehensive coverage and support for a healthier tomorrow.",
          },
        ],
  
        servicebox: [
          {
            title: "Minimum Waiting Period",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "Cashless Healthcare Facility",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "No Pre-policy Medical Check-ups",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Annual Health Check-ups",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "Some of the most common lifestyle conditions—obesity, diabetes, and high blood pressure—are gradually becoming serious health diseases among Indians today. An imbalanced way of living worsened by adulterated consumption is taking a toll on millions of lives every year. ",
              },
              {
                paragraph: " An inactive lifestyle, unhealthy eating habits, work pressure, and stress give rise to diabetes, hypertension & high BMI. Today, India is home to almost 77 million diabetic patients, the second-highest diabetes population globally.",
              },
            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "Annual Health Check-up",
              },
              {
                points: "No Pre-Policy Medical Check-up",
              },
              {
                points: "Life-long renewability",
              },
              {
                points: "Tax Benefit u/s 80 D",
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/eWAZrkDUuQw",
            broucher_url: "Brouchers/diabetes-health-insurance.pdf",
            questions: [
              {
                question: "What are Pre-existing Diseases?",
                answer: "Pre-exisiting diseases are conditions, ailments, injuries, or diseases for which any signs or symptoms leading to an illness or medical condition are presented when the policy is proposed.",
              },
              {
                question: "What is considered a pre-existing condition under a health insurance policy?",
                answer: "Under Care Freedom, diabetes, high blood pressure, and high BMI (Body Mass Index) is considered as pre-existing conditions. We provide medical and non-medical coverage for these conditions after the specified waiting period, subject to policy terms.",
              },
              {
                question: "Do I need to bear co-payment under the Care Freedom policy?",
                answer: "Yes, as a standard, people with pre-existing ailments need to bear 20 or 30% of the final claim amount payable. We shall pay the remaining amount up to the sum insured. However, you may opt for a co-payment waiver benefit by paying a slighty higher premium according to policy terms and conditions.",
              },
              {
                question: "How to get Health insurance for Pre-existing Diseases?",
                answer: "One can buy health insurance for pre-existing diseases similar to standard health insurance.",
              }      
            ]
          },
        ],
    },
    {
        title: "Heart Health Insurance",
        heading: "Protecting Hearts, Securing Futures: Heart Health Insurance with Blarkafin",
        description: [
          {
            paragraph:
              "Experience peace of mind with specialized coverage for heart health at Blarkafin. Our comprehensive insurance plans are tailored to safeguard your heart's well-being and ensure a secure future.",
          },
        ],
  
        servicebox: [
          {
            title: "Cashless & Reimbursement Facility",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "Annual Cardiac health check-up",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "Lifelong renewability",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Alternative Treatments",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "Care Heart health insurance plan offers insurance for heart disease. It offers individual health coverage (or either one person in a floater policy with two adults). We got you covered if you are diagnosed with a cardiac ailment in the past or has undergone a Cardiac surgery or related procedure. A health insurance plan in place saves you from unnecessary stress and healter-skelter.",
              }
            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "Pre & Post Hospitalization",
              },
              {
                points: "Pre-existing Heart Illness Covered",
              },
              {
                points: "Cardiac Annual Health Check-up",
              },
              {
                points: "AYUSH Coverage",
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/TKCbKLuBM18",
            broucher_url: "Brouchers/heart-health-insurance.pdf",
            questions: [
              {
                question: "Is there any sub-limits in the coverage?",
                answer: "Yes. There are sub-limits applicable on room rent, ICU charges, treatment of cataract, and treatment of Total Knee Replacement. Do refer to the policy T&C.",
              },
              {
                question: "Is there a co-payment clause in the policy?",
                answer: "Yes. We have a co-payment clause in the policy. The policyholders will have to bear a certain percentage of every claim amount from their pocket. Please refer to the policy T&C.",
              },
              {
                question: "What are the conditions when a person can opt for care heart?",               
                answer: "Undergone first time PTCA/CABG within 7 years period prior to commencement.Corrected Artrial Septal Defect(ASD) or Ventricular Septal Defect.Corrected Patent Ductus Arteriosous(PDA.)Cardiac conditions cured through RF Ablation.Angiogram but no medical intervention after test.",
              },
              {
                question:"What is the waiting period for heart insurance?",
                answer:"Care Heart has a 30-day initial waiting period and a waiting period of 24 months for pre-existing diseases and specified ailments."
              }    
            ]
          },
        ],
    },
    {
        title: "Cancer Insurance",
        heading: "Strength in Adversity: Cancer Insurance for Courageous Fighters",
        description: [
          {
            paragraph:
              "Blarkafin stands by your side with specialized cancer insurance, providing financial support and peace of mind during challenging times. Let us be your ally in the fight against cancer.",
          },
        ],
  
        servicebox: [
          {
            title: "Cashless & Reimbursement Facility",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "Annual Cardiac health check-up",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "In-Patient Care",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Day Care Treatment",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "A cancer insurance policy is a financial cover that lowers the burden of cancer treatment with coverage for hospitalisation, therapies, and other non-medical expenses. It is a financial safety net that helps people during the unprecedented detection of cancer. ",
              },
              {
                paragraph: "The cancer insurance plan offers complete protection from pre-hospitalization tests to patient care and post-hospitalization treatments. This way, people across ages can secure their health and savings against the life-threatening cancer disease accounting for over 10 million deaths in 2020.",
              },
            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "Lifelong cancer protection at an unbeatable price",
              },
              {
                points: "Easy Monthly and Quarterly Instalment Option",
              },
              {
                points: "Get rewarded for each claim-free year",
              },
              {
                points: "Coverage for Chemo, Radiotherapy & more",
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/Nk4lbnaA2eo",
            broucher_url: "Brouchers/cancer-health-insurance.pdf",
            questions: [
              {
                question: "Do I still need to buy cancer insurance plan if I already have health insurance?",
                answer: "Yes, you would need a separate cancer insurance since your basic health insurance may not cover the treatment cost of cancer. There will always be limitations in a standard health plan, which may not allow you to avail of the treatment that caters you complete coverage of your cancer treatment.",
              },
              {
                question: "Does the sum insured for my cancer insurance plan increase if I don’t claim it?",
                answer: "Yes, you will be entitled to a maximum of 50% no-claim bonus throughout the cancer treatment policy tenure as a reward for not requesting any claims.",
              },
              {
                question: "What is the payout option available under this cancer mediclaim policy?",
                answer: "Our cancer care policy is an indemnity-based health plan. We will cover the actual medical costs you incur during your cancer care within the policy period on a reimbursement or cashless basis, subject to policy terms and conditions.",
              }    
            ]
          },
        ],
    },
    {
        title: "Critical Illness Insurance",
        heading: "Shielding Your Future: Critical Illness Insurance with Blarkafin",
        description: [
          {
            paragraph:
              "Prepare for life's uncertainties with Blarkafin's Critical Illness Insurance, offering comprehensive coverage and support during challenging times. Safeguard your financial well-being and focus on recovery with confidence.",
          },
        ],
  
        servicebox: [
          {
            title: "Comprehensive Coverage",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "Affordable Premium",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "Quick Claim Settlements",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Cashless Claim Facility",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "Critical illness insurance is a medical cover that provides financial assistance to insured members in case of hospitalisation due to critical illnesses such as cancer, catastrophic burns, or coma, as pre-defined under the chosen policy.",
              }
            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "Psychiatric Counseling",
              },
              {
                points: "Covers 32 Critical Illnesses",
              },
              {
                points: "Mediclaim Policy with Low Premium & High Coverage  ",
              },
              {
                points: "EMI Option Available",
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/Nk4lbnaA2eo",
            broucher_url: "Brouchers/critical-health-insurance.pdf",
            questions: [
              {
                question: "Is it necessary to get a medical check-up before buying a critical illness policy?",
                answer: "The critical illness health insurance covers the treatment expenses for any 32 acute illnesses, as listed in the policy document.",
              },
              {
                question: "Is there any eligibility criteria for purchasing a Critical Illness Plan?",
                answer: "Yes. The eligibility criteria include minimum entry age for a child of 91 days to 4 years with at least one member of 18 years or above or 5 years on an individual basis.",
              },
              {
                question: "Can I Make multiple claims for the same or any other listed critical illness?",
                answer: "This policy is an indemnity cover, and the insured can make multiple claims in a policy year. However, all claims made will be processed subject to the policy terms and conditions.",
              } ,
              {
                question: "How should one decide on insurance for critical illness coverage?",
                answer: "When you buy critical illness insurance, it is essential to consider various factors such as the medical condition, treatment costs, and the waiting period to complete before getting a claim for your expenses.",
              }    
            ]
          },
        ],
    },
    {
        title: "One Crore Health Insurance",
        heading: "Peace of Mind, Millionfold: Blarkafin's One Crore Health Insurance",
        description: [
          {
            paragraph:
              "Secure your family's future with Blarkafin's One Crore Health Insurance, offering extensive coverage for medical expenses up to one crore rupees. Experience peace of mind knowing your loved ones are protected against unforeseen health challenges.",
          },
        ],
  
        servicebox: [
          {
            title: "Individual or Floater Option",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "Cover for Hospitalization Expenses",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "Daycare Treatment Cover",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Pre-and Post-Hospitalization Medical Expenses Cover",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "A 1 crore health insurance policy is all you need to meet the comprehensive healthcare needs of the entire family. The policy secures expansive healthcare benefits while ensuring lifelong coverage.",
              }
            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "Sum Insured options to choose from 25 Lacs, 50 Lacs or 1 Crore",
              },
              {
                points: "Up to 50% No Claim Bonus",
              },
              {
                points: "Coverage for Day care treatments",
              },
              {
                points: "In-Patient Hospitalization",
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/S6THyw66JL4",
            broucher_url: "Brouchers/one-crore-health-insurance.pdf",
            questions: [
              {
                question: "What is the Eligibility Criteria for Care Advantage?",
                answer: "The minimum entry age to opt for Care Advantage is: 5 years for individual, 91 Days with at least 1 member of age 18 years or above.For floater policy: There is no upper age limit for enrolment and no age limit for exit.",
              },
              {
                question: "Why You Should Opt for Care Advantage?",
                answer: "Care Advantage by Care Health Insurance is a comprehensive health policy with high sum insured of 1 Crore, 50L, and 25L. It is beneficial as it offers adequate coverage for various medical expenses, such as hospitalization expenses, pre and post hospitalization medical expenses and daycare treatment. It also offers tax benefits for the policyholder.",
              },
              {
                question: "Can I Buy Care Advantage without a Medical check-up?",
                answer: "As per the policy terms and conditions, No pre-policy medical check-up is required if no pre-existing declared for a person up to 50 years of age. For persons above the age of 51 years, there are specified medical tests, and the policy will be issued basis under tele writing.",
              }    
            ]
          },
        ],
    },
    {
        title: "Niva Bupa Re Assure",
        heading: "Niva Bupa Re Assure: Your Pathway to Reassured Health and Well-being",
        description: [
          {
            paragraph:
              "Discover the unparalleled reassurance of Niva Bupa Re Assure, a comprehensive health insurance solution meticulously designed to safeguard your health and provide peace of mind. With Niva Bupa Re Assure, embrace a future filled with confidence and security.",
          },
        ],
  
        servicebox: [
          {
            title: "Unlimited reinstatement of sum insured",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "30 min. cashless claims processing",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "Health check-up starting from day",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Doubles the sum insured in 2 claim free years",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "Niva Bupa’s ReAssure Health Insurance plan is a comprehensive health insurance plan designed to exceed your expectations and keep giving you more! The Niva Bupa ReAssure plan offers many features like a life-long renewal of premium where the amount is only affected by age and not claim status, unlimited reinstatement of the sum insured for all covered expenses, and the Booster Benefit that doubles the sum insured in 2 claim-free years. It even offers an incentive to live a healthy life with the Live Healthy benefit that lets you avail yourself discounts of up to 30% on renewal premium by collecting health points.",
              },

            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "Day 1 coverage for Hypertension & Diabetes",
              },
              {
                points: "Up to 30% discount on renewal premium basis steps taken",
              },
              {
                points: "Best Care with unlimited tele-consultations",
              },
              {
                points: "Unlimited reinstatements up to base sum insured in an year",
              },
              {
                points:"Get hassle-free cashless medical help at any of the network hospitals"
              },
              {
                points:"Get cover for even Ayurvedic, Unani, Siddha and Homeopathic treatments"
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/OxE0FjEOfq8",
            broucher_url: "Brouchers/Reassure-health-insurance.pdf",
            questions: [
              {
                question: "Is there any Tax benefit that one can avail while purchasing health insurance?",
                answer: "Yes. You can avail tax benefit available under Section 80D of the Income Tax Act 1961 by buying a health insurance policy. Every taxpayer can avail an annual deduction of Rs. 15,000 from his/her taxable income for premium for self, spouse and dependent children.",
              },
              {
                question: "Is a medical checkup necessary before buying a policy?",
                answer: "A medical checkup may be necessary when you sign up for a new health insurance policy. However, medical checkups are not usually needed for renewal of policies. It is in your best interests to undergo a medical check-up at the time of enrollment so that when you need us, we‘re there to provide speedy and efficient support and faster settlement of claims.",
              },
              {
                question: "Is Covid-19 covered under reassure family floater plan?",
                answer: "All our indemnity plans covers expenses incurred during the treatment for Coronavirus as per the terms and conditions of the ReAssure Family Floater plan.",
              }    
            ]
          },
        ],
    },
    {
        title: "Niva Bupa Health Companion",
        heading: "Niva Bupa Health Companion Plan: Your Trusted Partner in Health and Wellness",
        description: [
          {
            paragraph:
              "Embark on a journey to well-being with the Niva Bupa Health Companion Plan. Designed to be your steadfast ally in navigating life's health challenges, this plan offers comprehensive coverage and support, ensuring you and your loved ones receive the care you deserve. Choose Niva Bupa Health Companion for a healthier and happier future.",
          },
        ],
  
        servicebox: [
          {
            title: "No Co-pay",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "No Claim Bonus",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "Refill Benefit",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Alternative Treatments",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "A Health Insurance Plan with a host of smart features to give you everything you need in a health cover. It is truly the smarter way to manage your entire family's health",
              },

            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "Ayush Treatments are covered upto sum insured along with Pre & post hospitalizatoin expenses",
              },
              {
                points: "Cashless claim process within 30 minutes",
              },
              {
                points: "Safeguard Rider, truly cashless feature with coverage",
              },
              {
               points:"No claim bonus with base sum increases by 20% maximum up to 100% of base sum insured"
              },
              {
                points: "No room rent capping(Except for suit and above room category)",
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/_yuFbP8WoQw?si=pRd4bFU8MziAnhqC",
            broucher_url: "Brouchers/companion-health-insurance.pdf",
            questions: [
              {
                question: "What is top up with annual aggregate deductible option in health companion?",
                answer: "It becomes really difficult to decide how much cover is adequate. A cover which we find sufficient today becomes irrelevant tomorrow due to the rising medical inflation. At the same time buying a large insurance cover in the current policy may not be affordable or available.",
              },
              {
                question: "Why is a top-up important?",
                answer: "Top-up is important as it takes care of the gap between your existing coverage, and the actual cost incurred during the year.",
              },
              {
                question: "When does it make sense to opt for top-up?",
                answer: "It makes sense when you want to increase your total coverage without paying much. While anybody can buy our Top-up option at any time, however, it is not advisable unless you have bought a base health insurance cover or the coverage offered by your employer is at least equal to the chosen deductible (threshold limit) amount of our Top-up.",
              },
              {
                question:'Is covid-19 covered under health companion family floater plan?',
                answer:'All our indemnity plans covers expenses incurred during the treatment for Coronavirus as per the terms and conditions of the Health Companion Family Floater plan.'
              }    
            ]
          },
        ],
    },
    {
      title: "Niva Bupa ReAssure 2.0",
      heading: "Niva Bupa ReAssure 2.0: Elevating Your Health Assurance to New Heights",
      description: [
        {
          paragraph:
            "Experience the next level of health assurance with Niva Bupa ReAssure 2.0. Seamlessly blending comprehensive coverage and innovative features, this upgraded plan ensures your health and well-being are protected like never before. Trust Niva Bupa ReAssure 2.0 for a brighter and healthier tomorrow.",
        },
      ],
        servicebox: [
          {
            title: "Entry Age And Family Coverage",
            image: "https://www.blarkafin.com/images/first-img.png",
          },
          {
            title: "Organ Donor",
            image: "https://www.blarkafin.com/images/second-img.png",
          },
          {
            title: "Modern Treatments",
            image: "https://www.blarkafin.com/images/third-img.png",
          },
          {
            title: "Health Check-up",
            image: "https://www.blarkafin.com/images/fourth-img.png",
          },
        ],
  
        middlebox: [
          {
            right_title: "Importance of Health Insurance ?",
            right_description: [
              {
                paragraph: "Presenting ReAssure 2.0. A comprehensive plan, with many never heard of features, designed to give you and your family more than you expect from a health insurance plan.",
              },
              {
                paragraph: "From fixing your entry age (until you claim), ReAssure forever benefit, Booster+ benefit to Discounts for staying healthy. A plan that gives you more benefits for staying healthy and provides coverage when you need it. A plan that keeps giving you more, FOREVER!!!",
              },
            ],
            left_title: "Benefits of Health Insurance",
            left_pointer: [
              {
                points: "ReAssure+ with fixed entry age and ReAssure forever benefit",
              },
              {
                points: "Booster+ (up to 10 times of base sum insured)",
              },
              {
                points: "Inpatient Care (including AYUSH and Day care treatments)",
              },
              {
                points: "Modern Treatments",
              },
              {
                points:"Pre & Post Hospitalization Medical Expenses"
              },
              {
                points:"Annual Health Check-up form day 1"
              }
            ],
          },
        ],
        bottombox: [
          {
            video_url: "https://www.youtube.com/embed/xbSbZfcbDKM?si=_cmGZSEJQ1TOL_2p",
            broucher_url: "Brouchers/Reassure.2.0-health-insurance.pdf",
            questions: [
              {
                question: "Is there any Tax benefit that one can avail while purchasing health insurance?",
                answer: "Yes. You can avail tax benefit available under Section 80D of the Income Tax Act 1961 by buying a health insurance policy. Every taxpayer can avail an annual deduction of Rs. 15,000 from his/her taxable income for premium for self, spouse and dependent children.",
              },
              {
                question: "Is a medical checkup necessary before buying a policy?",
                answer: "A medical checkup may be necessary when you sign up for a new health insurance policy. However, medical checkups are not usually needed for renewal of policies. It is in your best interests to undergo a medical check-up at the time of enrollment so that when you need us, we‘re there to provide speedy and efficient support and faster settlement of claims.6-",
              },
              {
                question: "Is Covid-19 covered under reassure family floater plan?",
                answer: "All our indemnity plans covers expenses incurred during the treatment for Coronavirus as per the terms and conditions of the ReAssure Family Floater plan.",
              }    
            ]
          },
        ],
    },
  ];

  const FilteredData = insuranceData.filter((Elem) => {
    return Elem.title == storedInsurancePlan;
  });

  // Targeting compionents by ID

  //#Main Section
  let mainHeading = $("#main_heading");
  let mainParagraph = $("#main_paragraph");

  //#service box
  let serviceBoxRow = $("#servicebox");

  //#middle box
  let middleBox = $("#middlebox");
  let benefits = $("#benefits");

  //#bottomBox
  let videodiv = $("#video");
  let broucherDiv =$('#broucher');
  let questionsdiv = $("#questions");
  

  questionsdiv.append('<h4 class="card-title">How It Works?</h4>');
  FilteredData.map((data) => {
    //Main Section
    mainHeading.append(data.heading);
    data.description.map((description) => {
      mainParagraph.append(description.paragraph);
    });

    //Service Section
    data.servicebox.map((service) => {
      serviceBoxRow.append(`<div class="col-lg-3 col-md-6 mb20">
                            <div class="bloglist item">
                            <div class="post-content">
                                <div class="post-image">
                                <img alt="" src="images/news/1.jpg" />
                                </div>
                                <div class="post-text-custom">
                                <span class="p-tagline">Tips &amp Tricks</span>
                                
                                <p  style="font-size:0.8rem;"class="">
                                    ${service.title}   
                                </p>
                                
                                
                                </div>
                            </div>
                            </div>
     </div>`);
    });

    //Middle Section
    data.middlebox.map((middlebox_content) => {
      middleBox.append(`
        <h2>${middlebox_content.right_title}</h2>`);

      middlebox_content.right_description.map((paragraph) => {
        middleBox.append(`<p>${paragraph.paragraph}</p>`);
      });
    });

    data.middlebox.map((middlebox) => {
      middlebox.left_pointer.map((left_pointer) => {
        benefits.append(
            `<li class="d-flex "><i class="fa fa-check text-success "></i> <p style=margin-top:-7px>${left_pointer.points}</p></li>`
        );
      });
    });
//  left_pointer.points 
    //Bottom Section

    data.bottombox.map((bottombox) => {
      videodiv.append(
        `<iframe src="${bottombox.video_url}" frameborder="0" style="width: 100%; height:350px;"></iframe>`
      );
      broucherDiv.append(`  <a href="${bottombox.broucher_url}" target="_blank"  class="btn btn-secondary">Download Broucher</a>`);
      bottombox.questions.map((questions, index) => {
        questionsdiv.append(
          `<div class=""><h6>${index + 1}.${
            questions.question
          }</h6><p class="lh-sm" style="font-size:0.8rem;"> ${questions.answer}</p> </div>`
        );
      });
    });
  });

  
});
