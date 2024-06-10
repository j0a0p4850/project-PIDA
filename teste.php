<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Confirmation</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .hidden {
            display: none;
        }

        #confirmationMessage {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
            width: 300px;
            margin-top: 20px;
        }

        #confirmationMessage p {
            margin: 0 0 10px 0;
        }

        #confirmationMessage button {
            margin-right: 10px;
        }

        #reportModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }

        .modal-content h2 {
            margin-top: 0;
        }

        .modal-content label {
            display: block;
            margin-bottom: 10px;
        }

        .modal-content button {
            margin-top: 10px;
            margin-right: 10px;
        }

        #otherReasonInput {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <button id="cancelButton">Cancel</button>
    <div id="confirmationMessage" class="hidden">
        <p>Are you sure you want to cancel?</p>
        <button id="confirmCancelButton">Yes</button>
        <button id="dismissMessageButton">No</button>
    </div>

    <button id="reportButton">Report</button>

    <div id="reportModal" class="hidden">
        <div class="modal-content">
            <h2>Report Post</h2>
            <p>Select the reason for reporting this post:</p>
            <form action="temporario.php" id="reportForm" method="POST">
                <label><input type="checkbox" name="reason[]" value="Spam"> Spam</label><br>
                <label><input type="checkbox" name="reason[]" value="Inappropriate Content"> Inappropriate Content</label><br>
                <label><input type="checkbox" name="reason[]" value="Harassment"> Harassment</label><br>
                <label><input type="checkbox" name="reason[]" value="Other" id="otherCheckbox"> Other</label><br>
                <input type="text" id="otherReasonInput" name="otherReason" placeholder="Please describe the reason">
                <!-- Campo oculto para o ID da pergunta -->
                <input type="hidden" name="id_pergunta" value="5">
                <button type="submit" id="submitReportButton">Submit</button>
                <button type="button" id="cancelReportButton">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cancelButton = document.getElementById('cancelButton');
            const confirmationMessage = document.getElementById('confirmationMessage');
            const confirmCancelButton = document.getElementById('confirmCancelButton');
            const dismissMessageButton = document.getElementById('dismissMessageButton');

            cancelButton.addEventListener('click', function () {
                confirmationMessage.classList.remove('hidden');
            });

            confirmCancelButton.addEventListener('click', function () {
                // Handle the actual cancellation logic here
                confirmationMessage.classList.add('hidden');
                console.log('Cancelled');
            });

            dismissMessageButton.addEventListener('click', function () {
                confirmationMessage.classList.add('hidden');
            });

            const reportButton = document.getElementById('reportButton');
            const reportModal = document.getElementById('reportModal');
            const reportForm = document.getElementById('reportForm');
            const otherCheckbox = document.getElementById('otherCheckbox');
            const otherReasonInput = document.getElementById('otherReasonInput');
            const cancelReportButton = document.getElementById('cancelReportButton');

            reportButton.addEventListener('click', function () {
                reportModal.style.display = 'flex';
            });

            otherCheckbox.addEventListener('change', function () {
                if (otherCheckbox.checked) {
                    otherReasonInput.style.display = 'block';
                } else {
                    otherReasonInput.style.display = 'none';
                }
            });

            cancelReportButton.addEventListener('click', function () {
                reportModal.style.display = 'none';
            });
        });
    </script>
</body>

</html>
