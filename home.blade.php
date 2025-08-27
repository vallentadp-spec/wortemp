@extends('layouts.app')

@section('title', config('app.name'))

@section('styles')
<style>
.btn-outline-info.btn-modern {
    border: 2px solid #0dcaf0;
    color: #0dcaf0;
    background: transparent;
}

.btn-outline-info.btn-modern:hover {
    background: #0dcaf0;
    color: white;
    border-color: #0dcaf0;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(13, 202, 240, 0.3);
}

.btn-outline-info.btn-modern:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 202, 240, 0.25);
}

.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px 0 10px;
}

.main-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.feature-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
    height: 100%;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.feature-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 20px;
    color: white;
}

.feature-primary { background: linear-gradient(135deg, #667eea, #764ba2); }
.feature-success { background: linear-gradient(135deg, #56ab2f, #a8e6cf); }
.feature-warning { background: linear-gradient(135deg, #f093fb, #f5576c); }

.btn-modern {
    border-radius: 12px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.form-control-modern {
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    padding: 15px 20px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-control-modern:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.check-email-banner {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    border-radius: 15px;
    color: white;
    padding: 15px 20px;
    margin-bottom: 25px;
}

.domain-selector {
    position: relative;
}

.domain-display {
    background: #f8f9fa;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 15px 20px;
    font-size: 16px;
    color: #495057;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s ease;
    user-select: none;
}

.domain-display:hover {
    border-color: #667eea;
    background: #f0f2ff;
}

.domain-display.active {
    border-color: #667eea;
    background: #f0f2ff;
}

.domain-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 2px solid #667eea;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    margin-top: 5px;
    max-height: 200px;
    overflow-y: auto;
}

.domain-dropdown .dropdown-item {
    padding: 12px 20px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    font-size: 16px;
}

.domain-dropdown .dropdown-item:hover {
    background-color: #f0f2ff;
}

.domain-dropdown .dropdown-item:first-child {
    border-radius: 10px 10px 0 0;
}

.domain-dropdown .dropdown-item:last-child {
    border-radius: 0 0 10px 10px;
}

.page-header {
    margin-bottom: 30px;
}

.page-header h1 {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.page-header .lead {
    font-size: 1.1rem;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 20px 0 10px;
    }
    
    .main-card {
        margin: 0 15px;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
        font-size: 18px;
    }
}
</style>
@endsection

@section('content')

<div class="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="main-card text-center p-4">
                    <!-- Compact Header -->
                    <div class="page-header">
                        <div class="d-inline-block p-2 rounded-circle bg-primary bg-gradient mb-2">
                            <i class="fas fa-envelope-open fa-lg text-white"></i>
                        </div>
                        <h1 class="fw-bold text-primary mb-2">
                            Temporary Email Generator
                        </h1>
                        <p class="lead text-muted">
                            Create disposable email addresses instantly. Perfect for testing, signups, and protecting your privacy.
                        </p>
                    </div>

                    <!-- Check Email Banner (shows if emails exist) -->
                    <div id="check-email-section" class="check-email-banner" style="display: none;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div class="text-start">
                                <h6 class="mb-1">📧 You have saved emails!</h6>
                                <small class="opacity-75">Continue with your temporary emails</small>
                            </div>
                            <button type="button" class="btn btn-light btn-modern mt-2 mt-md-0" onclick="checkLastEmail()">
                                <i class="fas fa-inbox me-2"></i>Check Email
                            </button>
                        </div>
                    </div>

                    <!-- Create Email Form -->
                    <form id="create-email-form" class="mb-3">
                        <h5 class="mb-3 text-dark">🎯 Create Custom Email</h5>
                        <div class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <input type="text" id="email-input" class="form-control form-control-modern" 
                                       placeholder="Enter email name" required>
                            </div>
                            <div class="col-md-1 text-center">
                                <span class="fs-4 fw-bold text-muted">@</span>
                            </div>
                            <div class="col-md-3">
                                <div class="domain-selector">
                                    <div class="domain-display" onclick="toggleDomainSelector()">
                                        <span id="selected-domain">{{ $domains[0] ?? 'No domain' }}</span>
                                        <i class="fas fa-chevron-down ms-auto"></i>
                                    </div>
                                    
                                    <!-- Hidden domain selector -->
                                    <select id="domain-select" class="form-select form-control-modern" style="display: none;">
                                        @foreach($domains as $domain)
                                            <option value="{{ $domain }}" {{ $loop->first ? 'selected' : '' }}>{{ $domain }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <!-- Fixed Domain dropdown -->
                                    <div id="domain-dropdown" class="domain-dropdown" style="display: none;">
                                        @foreach($domains as $domain)
                                            <button type="button" class="dropdown-item" onclick="selectDomain('{{ $domain }}')">{{ $domain }}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-modern w-100">
                                    <i class="fas fa-plus me-2"></i>Create
                                </button>
                            </div>
                        </div>
                        
                        <!-- Generate Button for Email Field -->
                        <div class="mt-2">
                            <button type="button" class="btn btn-outline-info btn-modern btn-sm" onclick="generateEmailName()">
                                <i class="fas fa-magic me-2"></i>Generate Email Name
                            </button>
                        </div>
                    </form>

                    <!-- Quick Actions -->
                    <div class="row g-3">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success btn-modern w-100 py-2" onclick="createRandomEmail()">
                                <i class="fas fa-magic me-2"></i>
                                <div>
                                    <div class="fw-bold">Create Random Email</div>
                                    <small class="opacity-75">Instant random address with random domain</small>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Cards Section -->
        <div class="row mt-4 g-3">
            <div class="col-md-4">
                <div class="feature-card card text-center p-3">
                    <div class="feature-icon feature-primary">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Privacy Protected</h6>
                    <p class="text-muted small">Your real email address stays completely safe and private.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card card text-center p-3">
                    <div class="feature-icon feature-success">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Instant Access</h6>
                    <p class="text-muted small">No registration required. Generate emails instantly.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card card text-center p-3">
                    <div class="feature-icon feature-warning">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Mobile Friendly</h6>
                    <p class="text-muted small">Works perfectly on all devices and screen sizes.</p>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Check if user has created emails before
    const existingEmails = EmailStorage.get();
    if (existingEmails.length > 0) {
        $('#check-email-section').show();
        
        // Background validation to clean up invalid emails
        setTimeout(async () => {
            let hasValidEmails = false;
            
            for (const email of existingEmails) {
                try {
                    const response = await fetch(`/api/validate-email/${encodeURIComponent(email)}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        }
                    });
                    
                    if (response.ok) {
                        const data = await response.json();
                        if (data.exists) {
                            hasValidEmails = true;
                        } else {
                            EmailStorage.remove(email);
                        }
                    } else {
                        EmailStorage.remove(email);
                    }
                } catch (error) {
                    console.error(`Background validation error for ${email}:`, error);
                }
            }
            
            // Hide banner if no valid emails found
            if (!hasValidEmails) {
                $('#check-email-section').hide();
            }
        }, 100);
    } else {
        $('#check-email-section').hide();
    }

    // Initialize tooltip for admin button
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Auto-select first domain
    const firstDomain = $('#domain-select option:first').val();
    if (firstDomain) {
        $('#selected-domain').text(firstDomain);
    }

    // Create email form handler (yang sudah ada)
    $('#create-email-form').on('submit', function(e) {
        e.preventDefault();
        
        const email = $('#email-input').val().trim();
        const domain = $('#domain-select').val();
        
        if (!email || !domain) {
            showNotification('Error', 'Please fill in email name', 'error');
            return;
        }

        createEmail(email, domain);
    });

    // Hide dropdown when clicking outside (yang sudah ada)
    $(document).click(function(e) {
        if (!$(e.target).closest('.domain-selector').length) {
            $('#domain-dropdown').hide();
            $('.domain-display').removeClass('active');
        }
    });
});

function toggleDomainSelector() {
    const dropdown = $('#domain-dropdown');
    const display = $('.domain-display');
    
    if (dropdown.is(':visible')) {
        dropdown.hide();
        display.removeClass('active');
    } else {
        dropdown.show();
        display.addClass('active');
    }
}

function selectDomain(domain) {
    $('#selected-domain').text(domain);
    $('#domain-select').val(domain);
    $('#domain-dropdown').hide();
    $('.domain-display').removeClass('active');
}

function generateEmailName() {
    const btn = $('button:contains("Generate Email Name")');
    const originalText = btn.html();
    
    btn.html('<span class="loading-spinner"></span> Generating...').prop('disabled', true);
    
    $.ajax({
        url: '{{ route("generate.random") }}',
        method: 'GET',
        success: function(response) {
            if (response.success) {
                $('#email-input').val(response.username);
                
                // Add animation
                $('#email-input').addClass('pulse');
                setTimeout(() => {
                    $('#email-input').removeClass('pulse');
                }, 1000);
                
                showNotification('Generated', 'Email name generated! Now click Create.', 'success');
            }
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            showNotification('Error', response.error || 'Failed to generate email name', 'error');
        },
        complete: function() {
            btn.html(originalText).prop('disabled', false);
        }
    });
}

function createEmail(email, domain) {
    const btn = $('#create-email-form button[type="submit"]');
    const originalText = btn.html();
    
    btn.html('<span class="loading-spinner"></span> Creating...').prop('disabled', true);
    
    $.ajax({
        url: '{{ route("create.email") }}',
        method: 'POST',
        data: {
            email: email,
            domain: domain
        },
        success: function(response) {
            if (response.success) {
                EmailStorage.add(response.email);
                showNotification('Success', 'Email created successfully!', 'success');
                
                setTimeout(() => {
                    window.location.href = response.redirect_url;
                }, 1000);
            }
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            showNotification('Error', response.error || 'Failed to create email', 'error');
        },
        complete: function() {
            btn.html(originalText).prop('disabled', false);
        }
    });
}

function createRandomEmail() {
    const btn = $('button:contains("Create Random Email")').closest('button');
    const originalText = btn.html();
    
    btn.html('<span class="loading-spinner"></span> Creating...').prop('disabled', true);
    
    $.ajax({
        url: '{{ route("create.random") }}',
        method: 'POST',
        data: {
            domain: null // Let server pick random domain
        },
        success: function(response) {
            if (response.success) {
                EmailStorage.add(response.email);
                showNotification('Success', 'Random email created!', 'success');
                
                setTimeout(() => {
                    window.location.href = response.redirect_url;
                }, 1000);
            }
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            showNotification('Error', response.error || 'Failed to create random email', 'error');
        },
        complete: function() {
            btn.html(originalText).prop('disabled', false);
        }
    });
}

async function checkLastEmail() {
    const btn = $('button:contains("Check Email")');
    let originalText = '<i class="fas fa-inbox me-2"></i>Check Email';
    
    if (btn.length) {
        originalText = btn.html();
        btn.html('<span class="loading-spinner"></span> Checking...').prop('disabled', true);
    }
    
    try {
        const emails = EmailStorage.get();
        let validEmail = null;
        
        // Check emails from NEWEST to OLDEST (index 0 = terbaru)
        for (let i = 0; i < emails.length; i++) {
            const email = emails[i];
            
            try {
                const response = await fetch(`/api/validate-email/${encodeURIComponent(email)}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    if (data.exists) {
                        validEmail = email;
                        break; // Found valid email, stop checking
                    } else {
                        // Email not found in database, remove from localStorage
                        EmailStorage.remove(email);
                    }
                } else {
                    // Remove email if validation fails
                    EmailStorage.remove(email);
                }
            } catch (error) {
                console.error(`Error validating email ${email}:`, error);
                // On error, assume email is invalid and remove it
                EmailStorage.remove(email);
            }
        }
        
        if (validEmail) {
            // Show success message before redirect
            if (typeof showNotification === 'function') {
                showNotification('Success', `Opening mailbox for ${validEmail}`, 'success');
            }
            
            // Small delay to show notification
            setTimeout(() => {
                window.location.href = `/mailbox/${validEmail}`;
            }, 800);
        } else {
            // No valid emails found
            $('#check-email-section').hide();
            if (typeof showNotification === 'function') {
                showNotification('Info', 'No active emails found. Please create a new email!', 'info');
            }
        }
        
    } catch (error) {
        console.error('Error checking emails:', error);
        if (typeof showNotification === 'function') {
            showNotification('Error', 'Failed to check emails. Please try again.', 'error');
        }
    } finally {
        if (btn.length) {
            btn.html(originalText).prop('disabled', false);
        }
    }
}
</script>
@endsection
