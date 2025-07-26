@extends('layouts.layout_home')
@section('content')
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<link rel="stylesheet" href="/css/page/contact-styles.css">
<!-- EmailJS SDK -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

<!-- Language Switcher Styles -->
<style>
    /* Additional styles for loading and messages */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    .loading-spinner {
        display: none;
        width: 16px;
        height: 16px;
        border: 2px solid #ffffff;
        border-top: 2px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 8px;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .message-overlay {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
    }
    .message-content {
        background-color: white;
        margin: 15% auto;
        padding: 30px;
        border-radius: 15px;
        width: 90%;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    .message-content h3 {
        margin-bottom: 15px;
        font-size: 1.3rem;
    }
    .message-content p {
        margin-bottom: 20px;
        line-height: 1.6;
        color: #666;
    }
    .success-content h3 {
        color: #28a745;
    }
    .error-content h3 {
        color: #dc3545;
    }
    .message-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 10px 25px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .message-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    .form-error {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.2) !important;
    }
    .error-text {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
        display: none;
    }
</style>

<section class="contact-form-section">
    <div class="contact-container">
        <div class="form-container">
            <div class="form-header">
                <h2>{{ __('contact.contact_form_title') }}</h2>
                <p>{{ __('contact.contact_form_subtitle') }}</p>
            </div>
            <form id="contact-form" class="contact-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">{{ __('contact.name_label') }}</label>
                        <input type="text" id="name" name="name" placeholder="{{ __('contact.name_placeholder') }}" required>
                        <div class="error-text" id="name-error">{{ __('contact.name_error') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('contact.email_label') }}</label>
                        <input type="email" id="email" name="email" placeholder="{{ __('contact.email_placeholder') }}" required>
                        <div class="error-text" id="email-error">{{ __('contact.email_error') }}</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">{{ __('contact.phone_label') }}</label>
                        <input type="tel" id="phone" name="phone" placeholder="{{ __('contact.phone_placeholder') }}" required>
                        <div class="error-text" id="phone-error">{{ __('contact.phone_error') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="subject">{{ __('contact.subject_label') }}</label>
                        <select id="subject" name="subject" required>
                            <option value="" disabled selected>{{ __('contact.subject_placeholder') }}</option>
                            <option value="general">{{ __('contact.subject_general') }}</option>
                            <option value="service">{{ __('contact.subject_service') }}</option>
                            <option value="quote">{{ __('contact.subject_quote') }}</option>
                            <option value="partnership">{{ __('contact.subject_partnership') }}</option>
                            <option value="other">{{ __('contact.subject_other') }}</option>
                        </select>
                        <div class="error-text" id="subject-error">{{ __('contact.subject_error') }}</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">{{ __('contact.message_label') }}</label>
                    <textarea id="message" name="message" placeholder="{{ __('contact.message_placeholder') }}" rows="5" required></textarea>
                    <div class="error-text" id="message-error">{{ __('contact.message_error') }}</div>
                </div>
                <div class="form-group form-checkbox">
                    <input type="checkbox" id="privacy" name="privacy" required>
                    <label for="privacy">{{ __('contact.privacy_text') }}<a href="#" class="privacy-link">{{ __('contact.privacy_link') }}</a>{{ __('contact.privacy_consent') }}</label>
                    <div class="error-text" id="privacy-error">{{ __('contact.privacy_error') }}</div>
                </div>
                <button type="submit" class="btn btn-primary" id="submit-btn">
                    <span class="loading-spinner" id="loading-spinner"></span>
                    <span id="submit-text">{{ __('contact.submit_button') }}</span>
                </button>
            </form>
        </div>
        <div class="contact-info-container">
            <div class="contact-info-content">
                <h2>{{ __('contact.other_contact_title') }}</h2>
                <p>{{ __('contact.other_contact_subtitle') }}</p>
                <div class="contact-info-item">
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info">
                        <h3>{{ __('contact.working_hours_title') }}</h3>
                        <p>{{ __('contact.working_hours_weekday') }}</p>
                        <p>{{ __('contact.working_hours_weekend') }}</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="info">
                        <h3>{{ __('contact.customer_service_title') }}</h3>
                        <p>{{ __('contact.customer_service_phone') }}</p>
                        <p>{{ __('contact.customer_service_email') }}</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="info">
                        <h3>{{ __('contact.business_dept_title') }}</h3>
                        <p>{{ __('contact.business_dept_phone') }}</p>
                        <p>{{ __('contact.business_dept_email') }}</p>
                    </div>
                </div>
                <div class="social-media">
                    <h3>{{ __('contact.follow_us') }}</h3>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-line"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="map-section">
    <div class="map-container">
        <h2>{{ __('contact.location_title') }}</h2>
        <div class="map-wrapper">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.3826632348396!2d100.41160407586447!3d13.695258498598543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2bd6191c4dc0f%3A0x525332376dd66d01!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4lS7guIjguKPguLHguKrguIjguLHguKIg4Liq4Liy4LiB4Lil4LiB4LmI4Lit4Liq4Lij4LmJ4Liy4LiH4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1750735370996!5m2!1sth!2sth"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <div class="map-info">
            <div class="map-info-item">
                <i class="fas fa-subway"></i>
                <p>{{ __('contact.map_mrt') }}</p>
            </div>
            <div class="map-info-item">
                <i class="fas fa-car"></i>
                <p>{{ __('contact.map_parking') }}</p>
            </div>
            <div class="map-info-item">
                <i class="fas fa-info-circle"></i>
                <p>{{ __('contact.map_appointment') }}</p>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-container">
        <h2>{{ __('contact.cta_title') }}</h2>
        <p>{{ __('contact.cta_subtitle') }}</p>
        <div class="cta-buttons">
            <a href="tel:+66025557890" class="btn btn-secondary"><i class="fas fa-phone-alt"></i>
                {{ __('contact.call_us') }}</a>
            <a href="#contact-form" class="btn btn-primary"><i class="fas fa-envelope"></i> {{ __('contact.send_message') }}</a>
        </div>
    </div>
</section>

<!-- Success Message -->
<div id="success-message" class="message-overlay">
    <div class="message-content success-content">
        <h3>{{ __('contact.success_title') }}</h3>
        <p>{{ __('contact.success_message') }}</p>
        <button onclick="closeSuccessMessage()" class="message-btn">{{ __('contact.close') }}</button>
    </div>
</div>

<!-- Error Message -->
<div id="error-message" class="message-overlay">
    <div class="message-content error-content">
        <h3>{{ __('contact.error_title') }}</h3>
        <p id="error-text">{{ __('contact.error_message') }}</p>
        <button onclick="closeErrorMessage()" class="message-btn">{{ __('contact.close') }}</button>
    </div>
</div>

</main>

<script>
    // Initialize EmailJS
    (function() {
        emailjs.init('rJoednBWRySd43PyI');
    })();

    // Get current locale for JavaScript
    const currentLocale = '{{ app()->getLocale() }}';

    // Subject mapping for both languages
    const subjectMapping = {
        'th': {
            'general': '{{ __("contact.subject_general") }} / General Inquiry',
            'service': '{{ __("contact.subject_service") }} / Service Inquiry',
            'quote': '{{ __("contact.subject_quote") }} / Quote Request',
            'partnership': '{{ __("contact.subject_partnership") }} / Business Partnership',
            'other': '{{ __("contact.subject_other") }} / Other'
        },
        'en': {
            'general': 'General Inquiry / {{ __("contact.subject_general") }}',
            'service': 'Service Inquiry / {{ __("contact.subject_service") }}',
            'quote': 'Quote Request / {{ __("contact.subject_quote") }}',
            'partnership': 'Business Partnership / {{ __("contact.subject_partnership") }}',
            'other': 'Other / {{ __("contact.subject_other") }}'
        }
    };

    // Localized text for JavaScript
    const localizedText = {
        submitting: '{{ __("contact.submitting") }}',
        submitButton: '{{ __("contact.submit_button") }}',
        errorPrefix: currentLocale === 'th' ? 'เกิดข้อผิดพลาดในการส่งอีเมล: ' : 'Email sending error: '
    };

    // Form validation functions
    function validateField(fieldId, errorId, customValidator = null) {
        const field = document.getElementById(fieldId);
        const errorElement = document.getElementById(errorId);
        let isValid = true;

        if (customValidator) {
            isValid = customValidator(field.value);
        } else {
            isValid = field.value.trim() !== '';
        }

        if (!isValid) {
            field.classList.add('form-error');
            errorElement.style.display = 'block';
        } else {
            field.classList.remove('form-error');
            errorElement.style.display = 'none';
        }

        return isValid;
    }

    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function validateForm() {
        let isValid = true;

        isValid = validateField('name', 'name-error') && isValid;
        isValid = validateField('email', 'email-error', validateEmail) && isValid;
        isValid = validateField('phone', 'phone-error') && isValid;
        isValid = validateField('subject', 'subject-error') && isValid;
        isValid = validateField('message', 'message-error') && isValid;

        const privacyCheckbox = document.getElementById('privacy');
        const privacyError = document.getElementById('privacy-error');
        if (!privacyCheckbox.checked) {
            privacyError.style.display = 'block';
            isValid = false;
        } else {
            privacyError.style.display = 'none';
        }

        return isValid;
    }

    // Show loading state
    function showLoading() {
        const submitBtn = document.getElementById('submit-btn');
        const loadingSpinner = document.getElementById('loading-spinner');
        const submitText = document.getElementById('submit-text');

        submitBtn.disabled = true;
        loadingSpinner.style.display = 'inline-block';
        submitText.textContent = localizedText.submitting;
    }

    // Reset submit button
    function resetSubmitButton() {
        const submitBtn = document.getElementById('submit-btn');
        const loadingSpinner = document.getElementById('loading-spinner');
        const submitText = document.getElementById('submit-text');

        submitBtn.disabled = false;
        loadingSpinner.style.display = 'none';
        submitText.textContent = localizedText.submitButton;
    }

    // Show success message
    function showSuccessMessage() {
        document.getElementById('success-message').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    // Close success message
    function closeSuccessMessage() {
        document.getElementById('success-message').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Show error message
    function showErrorMessage(message) {
        document.getElementById('error-text').textContent = message;
        document.getElementById('error-message').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    // Close error message
    function closeErrorMessage() {
        document.getElementById('error-message').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Handle form submission
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }

        showLoading();

        const formData = new FormData(this);
        const data = {};
        for (const [key, value] of formData.entries()) {
            data[key] = value;
        }

        // Prepare email template parameters
        const templateParams = {
            to_email: 'ananthaxb@gmail.com',
            from_name: data.name,
            from_email: data.email,
            phone: data.phone,
            subject_type: subjectMapping[currentLocale][data.subject] || data.subject,
            message: data.message,
            subject: `${currentLocale === 'th' ? 'ข้อความจากเว็บไซต์' : 'Website Message'}: ${subjectMapping[currentLocale][data.subject] || data.subject} - ${data.name}`,
            full_message: `${currentLocale === 'th' ? 'รายละเอียดผู้ติดต่อ' : 'CONTACT DETAILS'}:
- ${currentLocale === 'th' ? 'ชื่อ-นามสกุล' : 'Full Name'}: ${data.name}
- ${currentLocale === 'th' ? 'อีเมล' : 'Email'}: ${data.email}
- ${currentLocale === 'th' ? 'เบอร์โทรศัพท์' : 'Phone'}: ${data.phone}
- ${currentLocale === 'th' ? 'หัวข้อ' : 'Subject'}: ${subjectMapping[currentLocale][data.subject] || data.subject}

${currentLocale === 'th' ? 'ข้อความ' : 'MESSAGE'}:
${data.message}

${currentLocale === 'th' ? 'กรุณาติดต่อกลับที่' : 'Please contact back at'} ${data.email} ${currentLocale === 'th' ? 'หรือ' : 'or'} ${data.phone}`.trim()
        };

        // Send email using EmailJS
        emailjs.send('Thome', 'template_shjqlbp', templateParams)
            .then(function(response) {
                console.log('SUCCESS!', response.status, response.text);
                resetSubmitButton();
                showSuccessMessage();
                document.getElementById('contact-form').reset();
                document.querySelectorAll('.form-error').forEach(el => el.classList.remove('form-error'));
                document.querySelectorAll('.error-text').forEach(el => el.style.display = 'none');
            }, function(error) {
                console.log('FAILED...', error);
                resetSubmitButton();
                showErrorMessage(`${localizedText.errorPrefix}${error.text || error.message || 'Unknown error'}`);
            });
    });

    // Real-time validation
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('name').addEventListener('blur', function() {
            validateField('name', 'name-error');
        });

        document.getElementById('email').addEventListener('blur', function() {
            validateField('email', 'email-error', validateEmail);
        });

        document.getElementById('phone').addEventListener('blur', function() {
            validateField('phone', 'phone-error');
        });

        document.getElementById('subject').addEventListener('change', function() {
            validateField('subject', 'subject-error');
        });

        document.getElementById('message').addEventListener('blur', function() {
            validateField('message', 'message-error');
        });

        document.getElementById('privacy').addEventListener('change', function() {
            const privacyError = document.getElementById('privacy-error');
            if (this.checked) {
                privacyError.style.display = 'none';
            }
        });

        // Clear error states on input
        document.querySelectorAll('input, select, textarea').forEach(function(element) {
            element.addEventListener('input', function() {
                if (this.classList.contains('form-error')) {
                    this.classList.remove('form-error');
                    const errorId = this.id + '-error';
                    const errorElement = document.getElementById(errorId);
                    if (errorElement) {
                        errorElement.style.display = 'none';
                    }
                }
            });
        });
    });

    // Close modals when clicking outside
    window.addEventListener('click', function(event) {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');
        if (event.target === successMessage) {
            closeSuccessMessage();
        }
        if (event.target === errorMessage) {
            closeErrorMessage();
        }
    });

    // Handle escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            if (successMessage.style.display === 'block') {
                closeSuccessMessage();
            }
            if (errorMessage.style.display === 'block') {
                closeErrorMessage();
            }
        }
    });
</script>
@endsection
