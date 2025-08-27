<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>@yield('title', config('app.name'))</title> 
     
    <!-- Bootstrap CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <!-- Font Awesome --> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> 
    <!-- jQuery --> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
    
    <style> 
        :root { 
            --primary-color: #3b82f6; 
            --secondary-color: #64748b; 
            --success-color: #10b981; 
            --danger-color: #ef4444; 
            --warning-color: #f59e0b; 
            --dark-color: #1e293b; 
        } 
 
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            min-height: 100vh; 
            display: flex;
            flex-direction: column;
        } 
 
        .card { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            backdrop-filter: blur(10px); 
            background: rgba(255,255,255,0.95); 
        } 
 
        .btn-primary { 
            background: var(--primary-color); 
            border: none; 
            border-radius: 10px; 
            padding: 12px 24px; 
            font-weight: 600; 
            transition: all 0.3s ease; 
        } 
 
        .btn-primary:hover { 
            background: #2563eb; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4); 
        } 
 
        .form-control { 
            border-radius: 10px; 
            border: 2px solid #e2e8f0; 
            padding: 12px 16px; 
            transition: all 0.3s ease; 
        } 
 
        .form-control:focus { 
            border-color: var(--primary-color); 
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25); 
        } 
 
        .navbar { 
            background: rgba(255,255,255,0.95) !important; 
            backdrop-filter: blur(10px); 
            border-bottom: 1px solid rgba(255,255,255,0.2); 
        } 

        /* Fix untuk navbar toggle di mobile */
        .navbar-toggler {
            border: none;
            padding: 4px 8px;
            outline: none !important;
            box-shadow: none !important;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0,0,0, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
            transition: all 0.3s ease;
        }

        .navbar-collapse {
            transition: all 0.3s ease-in-out;
        }
 
        .email-item { 
            border: 1px solid #e2e8f0; 
            border-radius: 10px; 
            transition: all 0.3s ease; 
        } 
 
        .email-item:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(0,0,0,0.1); 
        } 
 
        .unread { 
            background: linear-gradient(45deg, #f8fafc, #e2e8f0); 
            border-left: 4px solid var(--primary-color); 
        } 
 
        .pulse { 
            animation: pulse 2s infinite; 
        } 
 
        @keyframes pulse { 
            0% { opacity: 1; } 
            50% { opacity: 0.5; } 
            100% { opacity: 1; } 
        } 
 
        .floating-btn { 
            position: fixed; 
            bottom: 20px; 
            right: 20px; 
            z-index: 1000; 
        } 
 
        .loading-spinner { 
            display: inline-block; 
            width: 20px; 
            height: 20px; 
            border: 3px solid #f3f3f3; 
            border-top: 3px solid var(--primary-color); 
            border-radius: 50%; 
            animation: spin 1s linear infinite; 
        } 
 
        @keyframes spin { 
            0% { transform: rotate(0deg); } 
            100% { transform: rotate(360deg); } 
        }

        /* Main content wrapper */
        .main-wrapper {
            flex: 1;
        }

        /* Footer Styles - Moved from home page */
        .app-footer {
            margin-top: auto;
            padding: 30px 0 20px;
        }

        .footer-content {
            text-align: center;
        }

        .footer-divider {
            width: 50%;
            opacity: 0.3;
            margin: 0 auto 20px auto;
            border-color: rgba(255, 255, 255, 0.3);
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .footer-copyright {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            margin-bottom: 0;
        }
 
        @media (max-width: 768px) { 
            .container-fluid { 
                padding: 10px; 
            } 
             
            .card { 
                margin: 10px 0; 
            }

            .navbar-nav {
                text-align: center;
                margin-top: 10px;
            }

            .navbar-nav .nav-link {
                padding: 10px 0;
                border-bottom: 1px solid rgba(0,0,0,0.1);
            }

            .navbar-nav .nav-link:last-child {
                border-bottom: none;
            }

            .app-footer {
                padding: 20px 0 15px;
            }
        } 
    </style> 
     
    @yield('styles') 
</head> 
<body> 
    <!-- Navigation --> 
    <nav class="navbar navbar-expand-lg navbar-light fixed-top"> 
        <div class="container"> 
            <a class="navbar-brand fw-bold" href="{{ route('home') }}"> 
                @if($logo = App\Models\AppSetting::get('logo_path')) 
                    <img src="{{ asset('storage/' . $logo) }}" alt="Logo" height="40"> 
                @endif 
                {{ config('app.name', 'App') }} 
            </a> 
             
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> 
                <span class="navbar-toggler-icon"></span> 
            </button> 
             
            <div class="collapse navbar-collapse" id="navbarNav"> 
                <ul class="navbar-nav ms-auto"> 
                    <li class="nav-item"> 
                        <a class="nav-link" href="{{ route('home') }}" onclick="closeNavbar()"> 
                            <i class="fas fa-home"></i> Home 
                        </a> 
                    </li> 
                     
                    @if(Session::has('admin_authenticated')) 
                    <li class="nav-item"> 
                        <a class="nav-link" href="{{ route('admin.dashboard') }}" onclick="closeNavbar()"> 
                            <i class="fas fa-user-shield"></i> Admin Dashboard 
                        </a> 
                    </li> 
                    @endif 
                     
                </ul> 
            </div> 
        </div> 
    </nav> 
 
    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Main Content --> 
        <main style="margin-top: 80px;"> 
            @yield('content') 
        </main> 
    </div>

    <!-- Global Footer -->
    <footer class="app-footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-content">
                        <hr class="footer-divider">
                        <p class="footer-text">
                            <i class="fas fa-heart text-danger"></i> 
                            Made with love for privacy protection
                        </p>
                        <p class="footer-copyright">
                            © {{ date('Y') }}  {{ config('app.name', 'App') }} by Balai Pedia. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
 
    <!-- Toast Container --> 
    <div class="toast-container position-fixed bottom-0 end-0 p-3"> 
        <div id="notification-toast" class="toast" role="alert"> 
            <div class="toast-header"> 
                <i class="fas fa-bell text-primary me-2"></i> 
                <strong class="me-auto">Notification</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button> 
            </div> 
            <div class="toast-body"></div> 
        </div> 
    </div> 
    
    <!-- Bootstrap JS --> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
    
    <!-- DOMPurify --> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.5/purify.min.js"></script> 
     
    <script> 
        // CSRF token setup 
        $.ajaxSetup({ 
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            } 
        }); 

        // Function untuk menutup navbar di mobile setelah klik menu
        function closeNavbar() {
            const navbarCollapse = document.getElementById('navbarNav');
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse) {
                bsCollapse.hide();
            }
        }

        // Fix untuk toggle navbar di mobile
        $(document).ready(function() {
            // Pastikan navbar toggle berfungsi dengan benar
            $('.navbar-toggler').on('click', function(e) {
                e.preventDefault();
                const target = $(this).attr('data-bs-target');
                const navbarCollapse = $(target);
                
                // Toggle collapse
                if (navbarCollapse.hasClass('show')) {
                    navbarCollapse.collapse('hide');
                } else {
                    navbarCollapse.collapse('show');
                }
            });

            // Close navbar when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.navbar').length) {
                    $('.navbar-collapse.show').collapse('hide');
                }
            });

            // Request notification permission on page load 
            requestNotificationPermission(); 
        });
 
        // Notification function 
        function showNotification(title, message, type = 'info') { 
            const toast = $('#notification-toast'); 
            const toastBody = toast.find('.toast-body'); 
            const toastHeader = toast.find('.toast-header'); 
             
            // Set icon based on type 
            let icon = 'fas fa-info-circle'; 
            let iconClass = 'text-primary'; 
             
            switch(type) { 
                case 'success': 
                    icon = 'fas fa-check-circle'; 
                    iconClass = 'text-success'; 
                    break; 
                case 'error': 
                    icon = 'fas fa-exclamation-circle'; 
                    iconClass = 'text-danger'; 
                    break; 
                case 'warning': 
                    icon = 'fas fa-exclamation-triangle'; 
                    iconClass = 'text-warning'; 
                    break; 
            } 
             
            toastHeader.find('i').attr('class', icon + ' ' + iconClass + ' me-2'); 
            toastHeader.find('strong').text(title); 
            toastBody.text(message); 
             
            const bsToast = new bootstrap.Toast(toast[0]); 
            bsToast.show(); 
        } 
 
        // Push notification request 
        function requestNotificationPermission() { 
            if ('Notification' in window && Notification.permission === 'default') { 
                Notification.requestPermission(); 
            } 
        } 
 
        // Send push notification 
        function sendPushNotification(title, body) { 
            if ('Notification' in window && Notification.permission === 'granted') { 
                new Notification(title, { 
                    body: body, 
                    icon: '/favicon.ico' 
                }); 
            } 
        } 
 
        // Local storage helper for email list 
        const EmailStorage = { 
            get: function() { 
                const emails = localStorage.getItem('temp_emails'); 
                return emails ? JSON.parse(emails) : []; 
            }, 
             
            add: function(email) { 
                let emails = this.get(); 
                if (!emails.includes(email)) { 
                    emails.unshift(email); 
                    if (emails.length > 10) { 
                        emails = emails.slice(0, 10); 
                    } 
                    localStorage.setItem('temp_emails', JSON.stringify(emails)); 
                } 
            }, 
             
            remove: function(email) { 
                let emails = this.get(); 
                emails = emails.filter(e => e !== email); 
                localStorage.setItem('temp_emails', JSON.stringify(emails)); 
            }, 
             
            getLatest: function() { 
                const emails = this.get(); 
                return emails.length > 0 ? emails[0] : null; 
            } 
        }; 
    </script> 
     
    @yield('scripts') 
</body> 
</html>
