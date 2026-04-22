<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body>

    <!-- Main Content Container: This is where views that extend this layout will inject their content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Toast Notification Wrapper: Positioned at the bottom-right corner -->
    <div class="position-fixed bottom-0 end-0 p-3" style='z-index:1050'>
        <!-- Check if a 'success' message exists in the session to decide whether to render the toast -->
        @if (session('success'))
            <!-- The actual Toast element -->
            <div class="toast align-items-center bg-success" id='notificationToast' role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <!-- Toast Message Body -->
                    <div class="toast-body text-white" id='messageToast'>
                        {{ session('success') }}
                    </div>
                    <!-- Close Button -->
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Initialize any toasts on the page -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Find the single toast element by its ID
            const toastElement = document.getElementById('notificationToast');

            // If the element exists (which means a session success message was triggered)
            if (toastElement) {
                // Wrap it in a Bootstrap Toast instance and display it
                const toast = new bootstrap.Toast(toastElement);
                toast.show();
            }

        })
    </script>
</body>

</html>
