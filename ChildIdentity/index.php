<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Information Card</title>
    <style>
        .arihant{
  
  padding: 0.75rem 2rem;
  background-color: #a01818;
  height: 50px;
  color: #ffffff;
  border: none;
  border-radius: 4px;
  font-size: 1.1rem;
  cursor: pointer;
  transition: background-color 0.3s;

}
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: auto;
            height: auto;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-content {
            padding: 20px;
        }

        .card-content h2 {
            margin: 10px 0;
            font-size: 1.5em;
            color: #333;
        }

        .card-content h3 {
            margin: 5px 0;
            font-size: 1.2em;
            color: #777;
        }

        .card-content p {
            margin: 8px 0;
            color: #555;
            font-size: 1em;
        }

        .card-content a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #1e90ff;
            border: 1px solid #1e90ff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .card-content a:hover {
            background-color: #1e90ff;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="card">
        <img id='image' alt="Child Photo">
        <div class="card-content">
            <h2 id="childName">Child Name</h2>
            <br>
            <h3 id="parentName">Parent Name</h3>
            <p id="parentContactNumber">Phone: 123-456-7890</p>
            <p id="parentContactEmail">Email: parent@example.com</p>
            <br>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to get URL parameters
            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                const results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            // Function to base64 decode
            function base64Decode(str) {
                return Uint8Array.from(atob(str), c => c.charCodeAt(0));
            }

            // Function to decrypt data
            async function decryptData(encryptedData, key) {
                const iv = encryptedData.slice(0, 12);
                const encrypted = encryptedData.slice(12);
                const algorithm = { name: 'AES-GCM', iv: iv };
                const cryptoKey = await window.crypto.subtle.importKey(
                    'raw',
                    base64Decode(key),
                    algorithm,
                    false,
                    ['decrypt']
                );
                return await window.crypto.subtle.decrypt(algorithm, cryptoKey, encrypted);
            }

            async function updateLostStatus(ecid) {
                try {
                    const response = await fetch('updateLostStatus.php?ecid=' + ecid, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ lost: true })
                    });

                    if (response.ok) {
                        console.log('Child reported as lost successfully.');
                        window.location.href="/";
                    } else {
                        console.error('Failed to report child as lost.');
                    }
                } catch (error) {
                    console.error('Error reporting child as lost:', error);
                }
            }

            // Get the 'data' parameter from the URL
            const dataParam = getUrlParameter('data');
            const ecid = getUrlParameter('ecid');
            if (dataParam) {
                try {
                    // Parse the JSON data
                    const data = JSON.parse(dataParam);

                    // Populate the HTML with the extracted data
                    document.getElementById('childName').innerText = data.childFullName;
                    document.getElementById('parentName').innerText = 'Parent Name: ' + data.parent1FullName;
                    document.getElementById('parentContactNumber').innerText = 'Phone: ' + data.parent1ContactNumber;
                    document.getElementById('parentContactEmail').innerText = 'Email: ' + data.parent1ContactEmail;
                    document.getElementById('image').src = '\\FaceRecognition\\Backup\\' + ecid + '.png';

                    // Check if the username cookie value matches the one provided in the URL
                    const usernameCookie = '<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>';
                    if (usernameCookie === data.username) {
                        // Create a button element
                        const reportLostButton = document.createElement('button');
                        reportLostButton.innerText = 'Report as Lost';
                        reportLostButton.className = 'arihant';

                        const distressButton = document.createElement('button');
                        const brake = document.createElement('br');
                        distressButton.innerText = 'This Child is in Distress';
                        distressButton.className = 'arihant';

                        // Add an event listener to handle button click
                        reportLostButton.addEventListener('click', function () {
                            // Call function to update lost status
                            updateLostStatus(ecid);
                        });

                        // Append the button to the card content
                        document.querySelector('.card-content').appendChild(reportLostButton);
                        document.querySelector('.card-content').appendChild(brake);
                        document.querySelector('.card-content').appendChild(brake);
                        document.querySelector('.card-content').appendChild(distressButton);
                    }
                } catch (e) {
                    console.error('Error parsing JSON data:', e);
                }
            }
        });
    </script>
</body>

</html>