<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate QRIS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        #loading {
            display: none;
            width: 100px;
            height: 100px;
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #qrisImage {
            display: block;
            margin: 20px auto;
        }

        #responseContainer {
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-100 col-md-5 mx-auto">

    <!-- Header -->
    <header class="bg-blue-600 p-4 shadow-lg mt-5">
        <div class="container mx-auto text-center">
            <h1 class="text-white text-3xl font-bold">Generate QRIS Cronosengine</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-md">
        <div class="text-center mb-8">
        </div>
        <div id="responseContainer">
            <span id="loading"></span>
            <img id="qrisImage">
            <h5 class="text-2xl font-semibold text-center text-blue-600 mb-3" id="nmid"></h5>

        </div>

            <button id="sendRequest" class="w-full bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700 transition duration-300">
                Generate QRIS
            </button>

        <!-- Tempat untuk menampilkan QR Code -->

    </main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sendRequest').click(function() {
                $('#loading').show(); // Show loading animation

                $.ajax({
                    url: '<?= base_url('send-request') ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                            $('#loading').hide(); // Show loading animation
                            const qrisContent = response.responseData.qris.content;
                            const nmid = getNmid(qrisContent);
                            $('#nmid').text('NMID: ' + nmid);
                            $('#qrisImage').attr('src', response.responseData.qris.image).show();
                    },
                    error: function(xhr, status, error) {
                        $('#loading').hide(); // Show loading animation
                        console.error('AJAX error:', error);
                        console.error('Response:', xhr.responseText);
                    }
                });
            });
            function getNmid(content) {
            const nmidStart = content.indexOf('5914') + 4;
            const nmidEnd = content.indexOf('6009');
            return content.substring(nmidStart, nmidEnd);
        }
        });
    </script>
</body>
</html>
