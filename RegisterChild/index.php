<?php
if (!isset($_COOKIE['username'])) {
    header("Location: /Login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Information Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="date"],
        input[type="tel"],
        input[type="email"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        .input-group {
            margin-bottom: 15px;
        }
        button {
            padding: 15px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Child Information Form</h2>
        <form id="childForm" action="#" method="post" enctype="multipart/form-data">
            <label for="childFullName">Child Full Name:</label>
            <input type="text" id="childFullName" name="childFullName" required>

            <label for="childDob">Child Date of Birth:</label>
            <input type="date" id="childDob" name="childDob" required>

            <label for="parent1FullName">Parent 1 Full Name:</label>
            <input type="text" id="parent1FullName" name="parent1FullName" required>

            <label for="parent1ContactNumber">Parent 1 Contact Number:</label>
            <input type="tel" id="parent1ContactNumber" name="parent1ContactNumber" required>

            <label for="parent1ContactEmail">Parent 1 Contact Email (Optional):</label>
            <input type="email" id="parent1ContactEmail" name="parent1ContactEmail">

            <label for="parent2FullName">Parent 2 Full Name:</label>
            <input type="text" id="parent2FullName" name="parent2FullName" required>

            <label for="parent2ContactNumber">Parent 2 Contact Number:</label>
            <input type="tel" id="parent2ContactNumber" name="parent2ContactNumber" required>

            <label for="parent2ContactEmail">Parent 2 Contact Email (Optional):</label>
            <input type="email" id="parent2ContactEmail" name="parent2ContactEmail">

            <div class="input-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">I agree to the <a href="terms-and-policies.html" target="_blank">Terms and Policies</a></label>
            </div><br>

            <button type="submit" style="background-color:green">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('childForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const childFullName = document.getElementById('childFullName').value;
            const childDob = document.getElementById('childDob').value;
            const parent1FullName = document.getElementById('parent1FullName').value;
            const parent1ContactNumber = document.getElementById('parent1ContactNumber').value;
            const parent1ContactEmail = document.getElementById('parent1ContactEmail').value;
            const parent2FullName = document.getElementById('parent2FullName').value;
            const parent2ContactNumber = document.getElementById('parent2ContactNumber').value;
            const parent2ContactEmail = document.getElementById('parent2ContactEmail').value;

            const data = {
                username: "<?php echo htmlspecialchars($_COOKIE['username']); ?>",
                childFullName: childFullName,
                childDob: childDob,
                parent1FullName: parent1FullName,
                parent1ContactNumber: parent1ContactNumber,
                parent1ContactEmail: parent1ContactEmail,
                parent2FullName: parent2FullName,
                parent2ContactNumber: parent2ContactNumber,
                parent2ContactEmail: parent2ContactEmail
            };

            const jsonData = JSON.stringify(data);
            window.location.href = `/IPFSapi/send?data=${encodeURIComponent(jsonData)}`;
        });
    </script>
</body>
</html>
