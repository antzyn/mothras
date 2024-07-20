<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST Request dengan jQuery dan CodeIgniter</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#submitForm').click(function(event) {
                event.preventDefault(); // Mencegah form dari submit default

                var data = {
                    name: $('#name').val(),
                    email: $('#email').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('generate') ?>',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            console.log(response)
                            $('#result').html('Data berhasil dikirim!');
                        } else {
                            $('#result').html('Error: ' + response.message);
                        }
                    },
                    error: function() {
                        console.log(response)
                        $('#result').html('Terjadi kesalahan.');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>Kirim Data dengan jQuery dan CodeIgniter</h1>
    <form id="form" method="POST">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>
        <button id="submitForm" type="submit">Kirim</button>
    </form>
    <div id="result"></div>
</body>
</html>
