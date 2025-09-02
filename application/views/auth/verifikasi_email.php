<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Pendaftaran | Pusdahamnas Komnasham Republik Indonesia</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets_front/images/img-komnasham-favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/bootstrap.4.5.3.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/style.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .img-logo {
            width: 100%;
            max-width: 820px;
        }

        form {
            padding: 2rem;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background: #fff;
            max-width: 500px;
            margin: auto;
        }

        form .form-control {
            display: block;
            height: 50px;
            text-align: center;
            font-size: 1.25rem;
            margin-right: 0.5rem;
        }

        form .form-control:last-child {
            margin-right: 0;
        }

        #otp-timer {
            margin-top: 10px;
            text-align: center;
        }

        button:disabled {
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <div class="container" style="margin-top: 8%; margin-bottom: 3%;">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->flashdata('error_messages')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error_messages') ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif ?>

                <?php if ($this->session->flashdata('success_messages')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success_messages') ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif ?>

                <form id="otpForm" action="<?= site_url('auth/verifikasiKode') ?>" method="post" autocomplete="off">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <h4 class="text-center">Masukkan Kode Verifikasi</h4>
                    <p class="text-center">Kami telah mengirimkan email yang berisi kode verifikasi</p>

                    <div class="d-flex mb-3 gap-2 justify-content-center">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                            <input type="tel" name="code_<?= $i ?>" maxlength="1" pattern="[0-9]"
                                class="form-control text-center fs-4">
                        <?php endfor; ?>
                    </div>

                    <button type="submit" class="w-100 btn btn-primary" disabled>Verifikasi</button>
                    <button id="resendBtn" class="btn btn-secondary w-100 mt-2" disabled>Kirim Ulang Kode</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="<?= base_url() ?>assets_landing/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>assets_landing/js/bootstrap.4.5.3.min.js"></script>

    <script>
        const form = document.getElementById('otpForm');
        const inputs = form.querySelectorAll('input[type="tel"]');
        const submitBtn = form.querySelector('button[type="submit"]');
        const resendBtn = document.getElementById('resendBtn');
        let timeLeft = 6;
        let countdown;

        // Input OTP
        inputs.forEach((input, index) => {
            input.addEventListener('input', e => {
                e.target.value = e.target.value.replace(/\D/g, '').slice(-1);
                if (e.target.value && index < inputs.length - 1) inputs[index + 1].focus();
                checkFilled();
            });
            input.addEventListener('keydown', e => {
                if (e.key === 'Backspace' && !input.value && index > 0) inputs[index - 1].focus();
            });
            input.addEventListener('paste', e => {
                const paste = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
                if (paste) {
                    e.preventDefault();
                    paste.split('').forEach((d, i) => inputs[i].value = d);
                    inputs[Math.min(paste.length, inputs.length) - 1].focus();
                    checkFilled();
                }
            });
        });

        function checkFilled() {
            const allFilled = [...inputs].every(inp => /^\d$/.test(inp.value));
            submitBtn.disabled = !allFilled;
            if (allFilled) form.submit();
        }

        function startTimer() {
            clearInterval(countdown);
            resendBtn.disabled = true;
            resendBtn.textContent = `Kirim Ulang Kode (${timeLeft})`;
            countdown = setInterval(() => {
                timeLeft--;
                resendBtn.textContent = `Kirim Ulang Kode (${timeLeft})`;
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    resendBtn.disabled = false;
                    resendBtn.textContent = 'Kirim Ulang Kode';
                }
            }, 1000);
        }

        startTimer();

        resendBtn.addEventListener('click', function (e) {
            e.preventDefault();
            timeLeft = 6;
            startTimer();

            fetch('<?= site_url("auth/resendOTP") ?>', { method: 'POST' })
                .then(res => res.json())
                .then(data => {
                    document.querySelectorAll('.alert').forEach(el => el.remove());
                    const alertBox = document.createElement('div');
                    alertBox.className = `alert ${data.success ? 'alert-success' : 'alert-danger'} alert-dismissible fade show mt-3`;
                    alertBox.role = 'alert';
                    alertBox.innerHTML = `<strong>${data.success ? 'Berhasil' : 'Gagal'}</strong> ${data.message}<button type="button" class="close" data-dismiss="alert">&times;</button>`;
                    form.appendChild(alertBox);


                    if (data.success) {
                        inputs.forEach(inp => inp.value = '');
                        inputs[0].focus();
                        timeLeft = 6;
                        startTimer();
                    }
                })
                .catch(() => {
                    document.querySelectorAll('.alert').forEach(el => el.remove());
                    const alertBox = document.createElement('div');
                    alertBox.className = 'alert alert-danger alert-dismissible fade show mt-3';
                    alertBox.role = 'alert';
                    alertBox.innerHTML = `<strong>Gagal</strong> Terjadi kesalahan jaringan. Coba lagi nanti.<button type="button" class="close" data-dismiss="alert">&times;</button>`;
                    form.appendChild(alertBox);
                });
        });
    </script>

</body>

</html>