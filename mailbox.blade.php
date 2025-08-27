@extends('layouts.app')

@section('title', 'Mailbox - ' . $email)

@section('styles')
<style>
#deleteConfirmModal .modal-content {
    border-radius: 16px !important;
    overflow: hidden;
    animation: modalSlideIn 0.3s ease-out;
}

#deleteConfirmModal .modal-header {
    background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
    border-bottom: 1px solid #feb2b2;
}

#deleteConfirmModal .modal-title {
    font-weight: 600;
    font-size: 18px;
}

#deleteConfirmModal .alert {
    border-radius: 12px;
    margin-bottom: 16px;
}

#deleteConfirmModal .alert-warning {
    background: linear-gradient(135deg, #fffbf0 0%, #fef5e7 100%) !important;
    border-left: 4px solid #f6ad55;
}

#deleteConfirmModal .alert-danger {
    background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%) !important;
    border-left: 4px solid #fc8181;
}

#deleteConfirmModal .btn-danger {
    background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
    border: none;
    border-radius: 8px;
    font-weight: 500;
    padding: 10px 20px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(229, 62, 62, 0.3);
}

#deleteConfirmModal .btn-danger:hover {
    background: linear-gradient(135deg, #c53030 0%, #9c2626 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(229, 62, 62, 0.4);
}

#deleteConfirmModal .btn-secondary {
    background: #f7fafc;
    border: 2px solid #e2e8f0;
    color: #4a5568;
    border-radius: 8px;
    font-weight: 500;
    padding: 10px 20px;
    transition: all 0.3s ease;
}

#deleteConfirmModal .btn-secondary:hover {
    background: #edf2f7;
    border-color: #cbd5e0;
    color: #2d3748;
    transform: translateY(-1px);
}

#deleteConfirmModal .modal-backdrop {
    background-color: rgba(0, 0, 0, 0.6);
}

/* Animation for modal */
@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Loading spinner in button */
#deleteConfirmModal .spinner-border-sm {
    width: 0.875rem;
    height: 0.875rem;
    border-width: 0.125em;
}

/* Focus states for accessibility */
#deleteConfirmModal .btn:focus {
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
    outline: none;
}

#deleteConfirmModal .btn-danger:focus {
    box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.5);
}

.card {
    border-radius: 16px !important;
    border: none !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
    overflow: hidden;
    transition: all 0.3s ease;
}

#newEmailModal .text-center .custom-btn {
    padding: 9px 20px !important;   
    font-size: 14px !important;      
    height: auto !important;         
    display: inline-flex !important; 
    justify-content: center;         
    align-items: center;             
    width: auto !important;          
    border-radius: 6px !important;   
}

.refresh-rotating {
    animation: refreshSpin 0.8s ease-in-out;
    transform-origin: center;
}

@keyframes refreshSpin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.domain-selector-modal {
    position: relative;
}

.domain-display-modal {
    background: #f8f9fa;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    color: #495057;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s ease;
    user-select: none;
}

.domain-display-modal:hover {
    border-color: #667eea;
    background: #f0f2ff;
}

.domain-display-modal.active {
    border-color: #667eea;
    background: #f0f2ff;
}

.modal-domain-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 2px solid #667eea;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    z-index: 9999;
    margin-top: 5px;
    max-height: 200px;
    overflow-y: auto;
}

.modal-domain-dropdown .dropdown-item {
    padding: 10px 16px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    font-size: 14px;
}

.modal-domain-dropdown .dropdown-item:hover {
    background-color: #f0f2ff;
}

.modal-domain-dropdown .dropdown-item:first-child {
    border-radius: 6px 6px 0 0;
}

.modal-domain-dropdown .dropdown-item:last-child {
    border-radius: 0 0 6px 6px;
}

.email-item {
    transition: all 0.2s ease;
    border-radius: 8px;
    margin-bottom: 1px;
    cursor: pointer;
}

.email-item:hover {
    background-color: #f8f9fa;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.email-item.unread {
    background-color: #ffffff;
    border-left: 4px solid #1a73e8;
    font-weight: 500;
}

.email-item.read {
    background-color: #f8f9fa;
    color: #5f6368;
}

.sender-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 16px;
    flex-shrink: 0;
}

.email-content {
    flex: 1;
    min-width: 0;
}

.email-sender {
    font-weight: 600;
    color: #202124;
    font-size: 14px;
}

.email-subject {
    color: #202124;
    font-size: 14px;
    margin: 2px 0;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.email-preview {
    color: #5f6368;
    font-size: 13px;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.email-time {
    color: #5f6368;
    font-size: 12px;
    white-space: nowrap;
    flex-shrink: 0;
}

.email-actions {
    opacity: 0;
    transition: opacity 0.2s ease;
}

.email-item:hover .email-actions {
    opacity: 1;
}

.unread-dot {
    width: 8px;
    height: 8px;
    background-color: #1a73e8;
    border-radius: 50%;
    flex-shrink: 0;
}

.attachment-icon {
    color: #5f6368;
    font-size: 12px;
}

.star-icon {
    color: #fbbc04;
    cursor: pointer;
    transition: color 0.2s ease;
}

.star-icon:hover {
    color: #f9ab00;
}

.email-toolbar {
    background: white;
    border-bottom: 1px solid #e0e0e0;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.container-fluid {
    padding: 20px 16px;
}


.toolbar-section {
    display: flex;
    align-items: center;
    gap: 8px;
}

.compose-btn {
    background: #1a73e8;
    color: white;
    border: none;
    border-radius: 24px;
    padding: 12px 24px;
    font-weight: 500;
    box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    transition: all 0.2s ease;
}

.compose-btn:hover {
    background: #1557b0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

@media (max-width: 768px) {
    .email-item {
        padding: 12px 8px;
    }
    
    .sender-avatar {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }
    
    .container-fluid {
    padding: 10px 16px;
    }

    .email-actions {
        opacity: 1;
    }
    
     .col-lg-3, .col-md-4, 
    .col-lg-9, .col-md-8 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .email-toolbar .input-group {
        width: 100% !important;
    }

    .email-toolbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .email-toolbar .toolbar-section:last-child {
        width: 100%;
        display: flex;
        gap: 5px;
    }
    .email-html-container table {
     border-collapse: collapse;
    }
    #deleteConfirmModal .modal-dialog {
        margin: 1rem;
    }
    
    #deleteConfirmModal .modal-body {
        padding: 1.5rem 1rem;
    }
    
    #deleteConfirmModal .modal-footer {
        flex-direction: column-reverse;
        gap: 10px;
    }
    
    #deleteConfirmModal .modal-footer .btn {
        width: 100%;
    }
}
</style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar with Email Management -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-inbox text-primary me-2"></i> Mailbox
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Current Email -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small">CURRENT EMAIL</label>
                        <div class="input-group">
                            <input type="text" id="current-email" class="form-control border-0 bg-light" value="{{ $email }}" readonly>
                            <button class="btn btn-outline-secondary border-0" onclick="copyEmail()" title="Copy">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Email Selector -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small">SWITCH EMAIL</label>
                        <select id="email-selector" class="form-select border-0 bg-light">
                            <option value="">Select email...</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary compose-btn" onclick="showNewEmailModal()">
                            <i class="fas fa-plus me-2"></i> Create Email
                        </button>
                        <button class="btn btn-outline-primary" onclick="refreshEmails()">
                            <i class="fas fa-sync-alt me-2"></i> Refresh
                        </button>
                        <button class="btn btn-outline-danger" onclick="deleteCurrentEmail()">
                            <i class="fas fa-trash me-2"></i> Delete
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="mt-4">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="bg-light rounded p-3">
                                    <h5 id="total-emails" class="mb-1 text-primary fw-bold">0</h5>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded p-3">
                                    <h5 id="unread-emails" class="mb-1 text-warning fw-bold">0</h5>
                                    <small class="text-muted">Unread</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Email Content -->
        <div class="col-lg-9 col-md-8">
            <div class="card border-0 shadow-sm">
<div class="email-toolbar">
    <div class="toolbar-section">
        <h5 class="mb-0 d-flex align-items-center">
            <i class="fas fa-envelope text-primary me-2"></i>
            <span class="d-none d-md-inline">Inbox for</span>
            <span id="email-display" class="text-primary ms-1 d-inline-flex">{{ $email }}</span>
        </h5>
    </div>
    
    <div class="ms-auto toolbar-section">
        <div class="input-group" style="width: 300px;">
            <span class="input-group-text border-0 bg-light">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" id="search-input" class="form-control border-0 bg-light" 
                   placeholder="Search emails...">
        </div>
     <!--   <button class="btn btn-outline-secondary border-0" onclick="searchEmails()">
            <i class="fas fa-search"></i>
        </button> -->
    </div>
</div>

<script>
$(document).ready(function() {
    const email = '{{ $email }}';
    const parts = email.split('@');
    if (parts.length === 2) {
        $('#email-display').html(`
            <span class="text-primary">${parts[0]}</span><span class="text-muted">@${parts[1]}</span>
        `);
    }
});
</script>

                <div class="card-body p-0">
                    <!-- Email List -->
                    <div id="email-list">
                        <div class="text-center p-5">
                            <div class="loading-spinner mx-auto mb-3"></div>
                            <p class="text-muted">Loading emails...</p>
                        </div>
                    </div>
    
                    <!-- Pagination -->
                    <div id="pagination-container" class="p-3 border-top bg-light" style="display: none;">
                        <!-- Pagination will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Email Modal -->
<div class="modal fade" id="newEmailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle text-primary me-2"></i>Create New Email
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="new-email-form">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email Name</label>
                        <div class="input-group">
                            <input type="text" id="new-email-input" class="form-control" placeholder="Enter email name" required>
                            <span class="input-group-text">@</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Domain</label>
                        <select id="new-domain-select" class="form-select" required>
                            @foreach(\App\Models\Domain::getActiveDomains() as $domain)
                                <option value="{{ $domain }}" {{ $loop->first ? 'selected' : '' }}>{{ $domain }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-secondary" onclick="generateRandomForModal()">
                            <i class="fas fa-magic me-2"></i> Random
                        </button>
                        <button type="submit" class="btn btn-primary custom-btn">
                            <i class="fas fa-plus me-2"></i> Create Email
                        </button>
                        <button type="button" class="btn btn-success" onclick="createInstantRandomEmail()">
                            <i class="fas fa-magic me-2"></i> Create Instant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Email Detail Modal -->
<div class="modal fade" id="emailDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">

            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-envelope-open text-primary me-2"></i>Email Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="email-detail-content" class="email-detail-content">
                    <!-- Email content will be loaded here -->
                </div>
            </div>
            
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h5 class="modal-title">Preview Lampiran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="previewContent"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-4">
                    <div class="mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #ff6b6b, #ee5a24); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-trash-alt fa-2x text-white"></i>
                    </div>
                    <h6 class="mb-2">Delete Email Address</h6>
                    <p class="text-muted mb-0">Are you sure you want to delete this email address and all its messages?</p>
                </div>
                
                <div class="alert alert-warning border-0 bg-light">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle text-warning me-2"></i>
                        <small class="mb-0">
                            <strong>Email:</strong> <span id="delete-email-display" class="text-primary">{{ $email }}</span>
                        </small>
                    </div>
                </div>
                
                <div class="alert alert-danger border-0 bg-light">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-exclamation-triangle text-danger me-2 mt-1"></i>
                        <div>
                            <small class="mb-1 d-block"><strong>Warning:</strong></small>
                            <small class="text-muted">This action cannot be undone. All emails and data will be permanently deleted.</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirm-delete-btn">
                    <i class="fas fa-trash me-2"></i>Delete Permanently
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let currentPage = 1;
let totalPages = 1;
let refreshInterval;
let currentEmailAddress = '{{ $email }}';
const fetchSeconds = {{ $fetchSeconds }};

$(document).ready(function() {
    // Initialize
    loadEmailSelector();
    loadEmails();
    startAutoRefresh();

    // Search functionality
    $('#search-input').on('keypress', function(e) {
        if (e.which === 13) {
            searchEmails();
        }
    });

    // New email form
    $('#new-email-form').on('submit', function(e) {
        e.preventDefault();
        createNewEmail();
    });

    // Request notification permission
    requestNotificationPermission();
    
    $('#emailDetailModal').on('hidden.bs.modal', function () {
        $(this).find('button, [tabindex]').blur();
        setTimeout(() => {
            $('#searchEmails').focus();
       }, 50);
    });

    $('#previewModal').on('hidden.bs.modal', function () {
        $(this).find('button, [tabindex]').blur();
        setTimeout(() => {
            $('#emailDetailModal').modal('show');
        }, 50);
    });

    $('#emailDetailModal').on('show.bs.modal', function () {
        $(this).removeAttr('aria-hidden');
        $(this).attr('tabindex', '-1');
        $(this).css('display', 'block');
    });
    
    $('#emailDetailModal').on('hide.bs.modal', function () {
        $(this).attr('aria-hidden', 'true');
        $(this).removeAttr('tabindex');
    });
    
    $('#previewModal').on('show.bs.modal', function () {
        $(this).removeAttr('aria-hidden');
        $(this).attr('tabindex', '-1');
        $(this).css('display', 'block');
    });
    
    $('#previewModal').on('hide.bs.modal', function () {
        $(this).attr('aria-hidden', 'true');
        $(this).removeAttr('tabindex');
    });
});

// Generate avatar initials from email
function getAvatarInitials(email) {
    const name = email.split('@')[0];
    const initials = name.substring(0, 2).toUpperCase();
    return initials;
}

// Generate avatar color based on email
function getAvatarColor(email) {
    const colors = [
        'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
        'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
        'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
        'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
        'linear-gradient(135deg, #a8edea 0%, #fed6e3 100%)',
        'linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%)',
        'linear-gradient(135deg, #ff8a80 0%, #ea80fc 100%)'
    ];
    
    let hash = 0;
    for (let i = 0; i < email.length; i++) {
        hash = email.charCodeAt(i) + ((hash << 5) - hash);
    }
    
    return colors[Math.abs(hash) % colors.length];
}

function loadEmailSelector() {
    const emails = EmailStorage.get();
    const selector = $('#email-selector');
    
    selector.empty().append('<option value="">Select email...</option>');
    
    emails.forEach(email => {
        const selected = email === currentEmailAddress ? 'selected' : '';
        selector.append(`<option value="${email}" ${selected}>${email}</option>`);
    });
    
    selector.on('change', function() {
        const selectedEmail = $(this).val();
        if (selectedEmail && selectedEmail !== currentEmailAddress) {
            window.location.href = `/mailbox/${selectedEmail}`;
        }
    });
}

function loadEmails(page = 1, search = '') {
    const searchQuery = search || $('#search-input').val();
    
    $.ajax({
        url: `{{ route('mailbox.emails', $email) }}`,
        method: 'GET',
        data: {
            page: page,
            search: searchQuery
        },
        success: function(response) {
            displayEmails(response.emails);
            updateStats(response.emails);
            updatePagination(response.pagination);
            currentPage = page;
        },
        error: function(xhr) {
            $('#email-list').html(`
                <div class="text-center p-5">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <p class="text-muted">Failed to load emails</p>
                    <button class="btn btn-primary" onclick="loadEmails()">Retry</button>
                </div>
            `);
        }
    });
}

function toggleModalDomainSelector() {
    const dropdown = $('#modal-domain-dropdown');
    const display = $('.domain-display-modal');
    
    if (dropdown.is(':visible')) {
        dropdown.hide();
        display.removeClass('active');
    } else {
        dropdown.show();
        display.addClass('active');
    }
}

function selectModalDomain(domain) {
    $('#modal-selected-domain').text(domain);
    $('#new-domain-select').val(domain);
    $('#modal-domain-dropdown').hide();
    $('.domain-display-modal').removeClass('active');
}

function generateRandomForModal() {
    const btn = $('button:contains("Random")');
    const originalText = btn.html();
    
    btn.html('<span class="spinner-border spinner-border-sm"></span> Generating...').prop('disabled', true);
    
    $.ajax({
        url: '{{ route("generate.random") }}',
        method: 'GET',
        success: function(response) {
            if (response.success) {
                $('#new-email-input').val(response.username);
                
                $('#new-email-input').addClass('pulse');
                setTimeout(() => {
                    $('#new-email-input').removeClass('pulse');
                }, 1000);
                
                showNotification('Generated', 'Email name generated!', 'success');
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

$(document).ready(function() {
    const firstModalDomain = $('#new-domain-select option:first').val();
    if (firstModalDomain) {
        $('#modal-selected-domain').text(firstModalDomain);
    }
    
    $(document).click(function(e) {
        if (!$(e.target).closest('.domain-selector-modal').length) {
            $('#modal-domain-dropdown').hide();
            $('.domain-display-modal').removeClass('active');
        }
    });
});

function displayEmails(emails) {
    const emailList = $('#email-list');
    
    if (emails.length === 0) {
        emailList.html(`
            <div class="text-center p-5">
                <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
                <h5 class="text-muted">No emails yet</h5>
                <p class="text-muted mb-4">Emails sent to <strong>${currentEmailAddress}</strong> will appear here</p>
                <button class="btn btn-primary" onclick="refreshEmails()">
                    <i class="fas fa-sync me-2"></i>Check for emails
                </button>
            </div>
        `);
        return;
    }
    
    let html = '';
    emails.forEach(email => {
        const readClass = email.is_read ? 'read' : 'unread';
        const displayName = email.from_name || getDisplayName(email.from_email);
        const senderInitials = getAvatarInitials(displayName);
        const avatarColor = getAvatarColor(email.from_email);
        const timeAgo = formatDate(email.created_at);
        const hasAttachment = email.attachments && JSON.parse(email.attachments).length > 0;
        
        let preview = '';
        if (email.preview_text) {
            preview = email.preview_text;
        } else if (email.body_plain) {
            preview = truncateText(email.body_plain, 120);
        } else if (email.body_html) {
            preview = truncateText(stripHtml(email.body_html), 120);
        } else {
            preview = truncateText(stripHtml(email.body), 120);
        }
        
        html += `
            <div class="email-item ${readClass} p-3 d-flex align-items-center" onclick="showEmailDetail(${email.id})" data-email-id="${email.id}">
                ${!email.is_read ? '<div class="unread-dot me-3"></div>' : '<div class="me-3" style="width: 8px;"></div>'}
                
                <div class="sender-avatar me-3" style="background: ${avatarColor}">
                    ${senderInitials}
                </div>
                
                <div class="email-content me-3">
                    <div class="d-flex align-items-center mb-1">
                        <span class="email-sender me-2">${escapeHtml(displayName)}</span>
                        <small class="text-muted">&lt;${escapeHtml(email.from_email)}&gt;</small>
                    </div>
                    <div class="email-subject mb-1">${escapeHtml(email.subject || 'No Subject')} ${hasAttachment ? '<i class="fas fa-paperclip ms-2 attachment-icon"></i>' : ''}</div>
                    <div class="email-preview">${escapeHtml(preview)}</div>
                </div>
                
                <div class="email-time me-2">${timeAgo}</div>
                
                <div class="email-actions">
                    <button class="btn btn-sm btn-outline-primary" onclick="event.stopPropagation(); showEmailDetail(${email.id})" title="Open">
                        <i class="fas fa-envelope-open"></i>
                    </button>
                </div>
            </div>
        `;
    });
    
    emailList.html(html);
}

function showEmailDetail(emailId) {
    $.ajax({
        url: `{{ route('mailbox.mark-read', [$email, ':id']) }}`.replace(':id', emailId),
        method: 'POST',
        success: function() {
            const emailElement = $(`.email-item[data-email-id="${emailId}"]`);
            emailElement.removeClass('unread').addClass('read');
            emailElement.find('.unread-dot').remove();
            updateStats();
        }
    });
    
    $.ajax({
        url: `/mailbox/{{ $email }}/email/${emailId}`,
        method: 'GET',
        success: function(email) {
            const displayName = email.from_name || getDisplayName(email.from_email);
            const avatarInitials = getAvatarInitials(displayName);
            const avatarColor = getAvatarColor(email.from_email);
            const formattedDate = new Date(email.created_at).toLocaleString();
            
            let attachmentsHtml = '';
            if (email.attachments) {
                try {
                    const attachments = JSON.parse(email.attachments);
                    if (attachments.length > 0) {
                        attachmentsHtml = `
                            <hr>
                            <div class="attachments-section mt-4">
                                <h6><i class="fas fa-paperclip me-2"></i>Attachments</h6>
                                <ul class="list-unstyled">
                        `;
                        
                        attachments.forEach(att => {
                            attachmentsHtml += `
                                <li class="mb-2">
                                    <a href="javascript:void(0);" onclick="openPreviewModal('/storage/${att.path}')"
       class="text-decoration-none">
      <i class="fas fa-file me-2"></i>
      ${escapeHtml(att.filename)}
      <span class="text-muted small">(${formatBytes(att.size)})</span>
    </a>
                                </li>
                            `;
                        });
                        
                        attachmentsHtml += `
                                </ul>
                            </div>
                        `;
                    }
                } catch (e) {
                    console.error('Error parsing attachments', e);
                }
            }
            
            let emailBody = '';
            if (email.is_html && email.body_html) {
                const sanitizedHTML = DOMPurify.sanitize(email.body_html, {
                   ALLOWED_TAGS: [
                'p', 'div', 'span', 'a', 'br', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
                'ul', 'ol', 'li', 'strong', 'em', 'b', 'i', 'u', 'table',
                'tr', 'td', 'th', 'thead', 'tbody', 'tfoot', 'font', 'blockquote', 
                'img', 'center', 'nobr', 'meta'
            ],
            ALLOWED_ATTR: [
                'href', 'src', 'alt', 'title', 'class', 'style', 'colspan',
                'rowspan', 'border', 'cellpadding', 'cellspacing', 'color',
                'face', 'size', 'align', 'valign', 'bgcolor', 'width', 'height',
                'margin', 'padding', 'background', 'background-color',
                'font-family', 'font-size', 'font-weight', 'text-align',
                'line-height', 'border-collapse', 'border-spacing',
                'mso-line-height-rule', 'mso-table-lspace', 'mso-table-rspace'
            ],
            FORBID_ATTR: ['onclick', 'onload', 'onerror', 'onmouseover'],
            FORBID_TAGS: ['script', 'iframe', 'frame', 'object', 'embed', 'form', 'input'],
            ALLOW_DATA_ATTR: false,
            KEEP_CONTENT: true
                });
            
                emailBody = `
                    <div class="email-html-container">
                        <div class="email-html-content">${sanitizedHTML}</div>
                    </div>
                    <style>
                        .email-html-container {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            color: #333;
                            overflow-x: auto;
                        }
                        .email-html-container img {
                            max-width: 100%;
                            height: auto;
                        }
                        .email-html-container table {
                            border-collapse: collapse;
                           /* width: 100%; */
                        }
                        .email-html-container a {
                            color: #0066cc;
                            text-decoration: underline;
                        }
                    </style>
                `;
            } else if (email.body_plain) {
                emailBody = `<pre class="email-plain-content">${escapeHtml(email.body_plain)}</pre>`;
            } else {
                emailBody = `<pre class="email-plain-content">${escapeHtml(email.body)}</pre>`;
            }
            
            $('#email-detail-content').html(`
                <div class="d-flex align-items-start mb-4">
                    <div class="sender-avatar me-3" style="background: ${avatarColor}; width: 48px; height: 48px; font-size: 18px;">
                        ${avatarInitials}
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">${escapeHtml(email.subject || 'No Subject')}</h6>
                        <div class="text-muted small mb-2">
                            <strong>${escapeHtml(displayName)}</strong> &lt;${escapeHtml(email.from_email)}&gt;
                        </div>
                        <div class="text-muted small">
                            <i class="fas fa-clock me-1"></i>${formattedDate}
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="email-body-content">
                    ${emailBody}
                </div>
                ${attachmentsHtml}
            `);
            
            const modal = new bootstrap.Modal(document.getElementById('emailDetailModal'));
            modal.show();
            
            fixInlineImages(JSON.parse(email.attachments || '[]'));
            
            $('#emailDetailModal').on('shown.bs.modal', function() {
               $('.email-html-container').find('a').attr('target', '_blank');
               $('.email-html-container').find('div:empty, p:empty, span:empty').remove();
               $('.email-html-container table').wrap('<div class="table-responsive"></div>');
            });
        },
        error: function() {
            showNotification('Error', 'Failed to load email details', 'error');
        }
    });
}

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

function normalizeCid(v) {
  if (!v) return '';
  return v.replace(/^cid:/i, '').replace(/[<>]/g, '').trim();
}

function fixInlineImages(attachments) {
  try {
    const normalizeCid = v =>
      (v || "").toString().replace(/^cid:/i, "").replace(/[<>]/g, "").trim();

    const cidMap = {};
    (attachments || []).forEach(att => {
      const cid = normalizeCid(att.cid || att.content_id || att.contentId);
      const url = att.url || (att.path ? `/storage/${att.path}` : "");
      if (cid && url) cidMap[cid] = url;
    });

    const container = document.querySelector('#email-detail-content');
    if (!container) return;

    container.querySelectorAll('img').forEach(img => {
      const src = (img.getAttribute('src') || '').trim();
      if (/^cid:/i.test(src)) {
        const key = normalizeCid(src);
        if (cidMap[key]) {
          img.setAttribute('src', cidMap[key]);
          img.setAttribute('data-inlined', 'true');
        } else {
          const wrap = img.closest('a');
          (wrap || img).remove();
        }
      }
    });
  } catch(e) {
    console.warn('fixInlineImages error:', e);
  }
}

function openPreviewModal(url) {
  const emailModal = bootstrap.Modal.getInstance(document.getElementById('emailDetailModal'));
  emailModal.hide();

  setTimeout(() => {
    const ext = url.split('.').pop().toLowerCase();
    let content = '';
    const fullUrl = '' + url;

    const dangerousExtensions = ['exe', 'bat', 'cmd', 'com', 'pif', 'scr', 'vbs', 'js', 'jar', 'sh', 'php', 'asp', 'jsp', 'msi'];
    const imageExtensions = ['png', 'jpg', 'jpeg', 'gif', 'webp', 'bmp', 'svg'];
    
    if (dangerousExtensions.includes(ext)) {
      content = `
        <div class="text-center p-4">
          <i class="fas fa-shield-alt fa-3x text-danger mb-3"></i>
          <h5>Security Alert</h5>
          <p class="text-muted">This file type is blocked for security reasons.</p>
          <p class="small text-danger">${ext.toUpperCase()} files are not allowed.</p>
        </div>
      `;
    } else if (imageExtensions.includes(ext)) {
      content = `
        <div class="text-center">
          <img src="${fullUrl}" class="img-fluid" style="max-height: 500px;" />
          <div class="mt-3">
            <a href="${fullUrl}" download class="btn btn-primary">
              <i class="fas fa-download me-2"></i> Download Image
            </a>
          </div>
        </div>
      `;
    } else if (ext === 'pdf') {
      content = `
        <div>
          <embed src="${fullUrl}" type="application/pdf" width="100%" height="500px" />
          <div class="text-center mt-3">
            <a href="${fullUrl}" download class="btn btn-primary">
              <i class="fas fa-download me-2"></i> Download PDF
            </a>
          </div>
        </div>
      `;
    } else {
      const fileTypes = {
        'zip': 'ZIP Archive',
        'rar': 'RAR Archive',
        '7z': '7-Zip Archive',
        'txt': 'Text File',
        'csv': 'CSV File',
        'doc': 'Word Document',
        'docx': 'Word Document',
        'xls': 'Excel Spreadsheet',
        'xlsx': 'Excel Spreadsheet',
        'ppt': 'PowerPoint',
        'pptx': 'PowerPoint',
        'json': 'JSON File',
        'xml': 'XML File'
      };
      
      const fileType = fileTypes[ext] || ext.toUpperCase() + ' File';
      
      content = `
        <div class="text-center p-4">
          <i class="fas fa-file-download fa-3x text-primary mb-3"></i>
          <h5>${fileType}</h5>
          <p class="text-muted">This file type can be downloaded but not previewed.</p>
          <div class="mt-3">
            <a href="${fullUrl}" download class="btn btn-primary">
              <i class="fas fa-download me-2"></i> Download File
            </a>
          </div>
        </div>
      `;
    }

    document.getElementById('previewContent').innerHTML = content;
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    previewModal.show();
  }, 400);
}

function updateStats(emails = null) {
    if (emails) {
        const total = emails.length;
        const unread = emails.filter(email => !email.is_read).length;
        
        $('#total-emails').text(total);
        $('#unread-emails').text(unread);
    } else {
        const total = $('.email-item').length;
        const unread = $('.email-item.unread').length;
        
        $('#total-emails').text(total);
        $('#unread-emails').text(unread);
    }
}

function downloadFile(url, filename) {
  try {
    const link = document.createElement('a');
    link.href = url;
    link.download = filename || url.split('/').pop();
    link.target = '_blank';
    
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
  } catch (error) {
    window.open(url, '_blank');
  }
}

function updatePagination(pagination) {
    const container = $('#pagination-container');
    
    if (pagination.last_page <= 1) {
        container.hide();
        return;
    }
    
    let html = '<nav><ul class="pagination justify-content-center mb-0">';
    
    if (pagination.current_page > 1) {
        html += `<li class="page-item">
            <a class="page-link" href="#" onclick="loadEmails(${pagination.current_page - 1})">
                <i class="fas fa-chevron-left"></i>
            </a>
        </li>`;
    }
    
    for (let i = 1; i <= pagination.last_page; i++) {
        const active = i === pagination.current_page ? 'active' : '';
        html += `<li class="page-item ${active}">
            <a class="page-link" href="#" onclick="loadEmails(${i})">${i}</a>
        </li>`;
    }
    
    if (pagination.current_page < pagination.last_page) {
        html += `<li class="page-item">
            <a class="page-link" href="#" onclick="loadEmails(${pagination.current_page + 1})">
                <i class="fas fa-chevron-right"></i>
            </a>
        </li>`;
    }
    
    html += '</ul></nav>';
    container.html(html).show();
}

function refreshEmails() {
    const btn = $('button:contains("Refresh")');
    const originalText = btn.html();
    
    const wasAutoRefreshing = !!refreshInterval;
    if (wasAutoRefreshing) {
        stopAutoRefresh();
    }
    
    btn.html('<span class="loading-spinner"></span> Refreshing...').prop('disabled', true);
    
    $.ajax({
        url: `{{ route('mailbox.refresh', $email) }}`,
        method: 'POST',
        success: function(response) {
            if (response.success) {
                if (response.new_emails_count > 0) {
                    showNotification('New Emails', `${response.new_emails_count} new email(s) received!`, 'success');
                    sendPushNotification('New Email', `You have ${response.new_emails_count} new email(s)`);
                } else {
                    showNotification('Up to date', 'No new emails found', 'info');
                }
                
                loadEmails(currentPage);
            }
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            showNotification('Error', response.error || 'Failed to refresh emails', 'error');
        },
        complete: function() {
            btn.html(originalText).prop('disabled', false);
            
            if (wasAutoRefreshing) {
                setTimeout(() => {
                    startAutoRefresh();
                }, 1000);
            }
        }
    });
}

function createInstantRandomEmail() {
    const btn = $('button:contains("Create Instant")');
    const originalText = btn.html();
    
    btn.html('<span class="loading-spinner"></span> Creating...').prop('disabled', true);
    
    $.ajax({
        url: '{{ route("create.random") }}',
        method: 'POST',
        data: {
            domain: null
        },
        success: function(response) {
            if (response.success) {
                EmailStorage.add(response.email);
                showNotification('Success', 'Random email created instantly!', 'success');
                
                bootstrap.Modal.getInstance(document.getElementById('newEmailModal')).hide();
                
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

function searchEmails() {
    currentPage = 1;
    loadEmails(1, $('#search-input').val());
}

function copyEmail() {
    const email = $('#current-email').val();
    navigator.clipboard.writeText(email).then(() => {
        showNotification('Copied', 'Email address copied to clipboard!', 'success');
    });
}

function deleteCurrentEmail() {
    // Update email display in modal
    $('#delete-email-display').text(currentEmailAddress);
    
    // Show modal instead of confirm dialog
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    deleteModal.show();
    
    // Handle delete confirmation
    $('#confirm-delete-btn').off('click').on('click', function() {
        const btn = $(this);
        const originalText = btn.html();
        
        // Show loading state
        btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Deleting...').prop('disabled', true);
        
        $.ajax({
            url: `{{ route('mailbox.delete', $email) }}`,
            method: 'DELETE',
            success: function(response) {
                if (response.success) {
                    EmailStorage.remove(currentEmailAddress);
                    showNotification('Success', 'Email deleted successfully!', 'success');
                    
                    // Hide modal
                    deleteModal.hide();
                    
                    // Redirect after successful deletion
                    const emails = EmailStorage.get();
                    if (emails.length > 0) {
                        setTimeout(() => {
                            window.location.href = `/mailbox/${emails[0]}`;
                        }, 1000);
                    } else {
                        setTimeout(() => {
                            window.location.href = '{{ route("home") }}';
                        }, 1000);
                    }
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                showNotification('Error', response.error || 'Failed to delete email', 'error');
                
                // Restore button state
                btn.html(originalText).prop('disabled', false);
            }
        });
    });
}

function showNewEmailModal() {
    new bootstrap.Modal(document.getElementById('newEmailModal')).show();
}

function createNewEmail() {
    const email = $('#new-email-input').val().trim();
    const domain = $('#new-domain-select').val();
    
    if (!email || !domain) {
        showNotification('Error', 'Please fill in all fields', 'error');
        return;
    }
    
    const btn = $('#new-email-form button[type="submit"]');
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
                
                bootstrap.Modal.getInstance(document.getElementById('newEmailModal')).hide();
                
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

function startAutoRefresh() {
    function triggerRotation() {
        const refreshIcon = $('button:contains("Refresh")').find('i');
        
        refreshIcon.removeClass('refresh-rotating');
        refreshIcon[0].offsetHeight;
        refreshIcon.addClass('refresh-rotating');
        
        setTimeout(() => {
            refreshIcon.removeClass('refresh-rotating');
        }, 800);
    }
    
    triggerRotation();
    
    refreshInterval = setInterval(function() {
        triggerRotation();
        
        $.ajax({
            url: `{{ route('mailbox.refresh', $email) }}`,
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    loadEmails(currentPage);
                    
                    if (response.new_emails_count > 0) {
                        showNotification('New Emails', `${response.new_emails_count} new email(s) received!`, 'success');
                        sendPushNotification('New Email', `You have ${response.new_emails_count} new email(s)`);
                    }
                }
            },
            error: function(xhr) {
                loadEmails(currentPage);
            }
        });
    }, fetchSeconds * 1000);
}

function stopAutoRefresh() {
    if (refreshInterval) {
        clearInterval(refreshInterval);
    }
    
    const refreshIcon = $('button:contains("Refresh")').find('i');
    refreshIcon.removeClass('refresh-rotating');
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function stripHtml(html) {
    const div = document.createElement('div');
    div.innerHTML = html;
    return div.textContent || div.innerText || '';
}

function truncateText(text, length) {
    return text.length > length ? text.substring(0, length) + '...' : text;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diff = now - date;
    const minutes = Math.floor(diff / 60000);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);
    
    if (minutes < 1) return 'Just now';
    if (minutes < 60) return `${minutes}m ago`;
    if (hours < 24) return `${hours}h ago`;
    if (days < 7) return `${days}d ago`;
    
    return date.toLocaleDateString();
}

$(window).on('beforeunload', function() {
    stopAutoRefresh();
});
</script>
@endsection
