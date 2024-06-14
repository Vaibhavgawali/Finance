<!DOCTYPE html>
<html>

<head>
    <title>Payment Success</title>
</head>

<body>
    <h1>Payment Success</h1>
    <p>Thank you for your payment!</p>
    <ul>
        <li>Insurer ID: {{ $insurerId }}</li>
        <li>Policy Status: {{ $policyStatus }}</li>
        <li>Policy Number: {{ $policyNumber }}</li>
        <li>Total Premium: {{ $totalPremium }}</li>
        <li>Enquiry Number: {{ $enquiryNo }}</li>
    </ul>
</body>

</html>
