@extends('layouts.app')

@section('title', 'Terms of Service - One Place Agro')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-background-light dark:bg-surface-dark shadow-xl overflow-y-auto min-h-screen sm:min-h-0 sm:rounded-[2rem] relative flex flex-col">
    
    <!-- Header Section -->
    <div class="sticky top-0 z-10 bg-gradient-to-r from-primary to-orange-400 px-6 py-4 shadow-lg">
        <div class="flex items-center gap-4">
            <button onclick="window.history.back()" class="text-white hover:bg-white/20 rounded-full p-2 transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </button>
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-white">Terms of Service</h1>
                <p class="text-white/90 text-sm">Last updated: {{ date('F d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="flex-1 px-6 py-8 space-y-6">
        
        <!-- Introduction -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">1. Introduction</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                Welcome to One Place Agro ("we," "our," or "us"). These Terms of Service ("Terms") govern your access to and use of our orange trading platform, including our website, mobile application, and related services (collectively, the "Service").
            </p>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                By accessing or using our Service, you agree to be bound by these Terms. If you do not agree to these Terms, please do not use our Service.
            </p>
        </section>

        <!-- Eligibility -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">2. Eligibility</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                You must be at least 18 years old to use our Service. By using our Service, you represent and warrant that you meet this age requirement and have the legal capacity to enter into these Terms.
            </p>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                For farmers and traders, you must also possess valid business registration or farming credentials as required by Indian law.
            </p>
        </section>

        <!-- Account Registration -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">3. Account Registration</h2>
            <div class="space-y-2">
                <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                    To access certain features of our Service, you must create an account. You agree to:
                </p>
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                    <li>Provide accurate, current, and complete information during registration</li>
                    <li>Maintain and promptly update your account information</li>
                    <li>Keep your password secure and confidential</li>
                    <li>Notify us immediately of any unauthorized access to your account</li>
                    <li>Accept responsibility for all activities that occur under your account</li>
                </ul>
            </div>
        </section>

        <!-- User Roles -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">4. User Roles and Responsibilities</h2>
            
            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-3">
                <h3 class="text-lg font-semibold text-primary">4.1 Farmers</h3>
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                    <li>Must provide accurate information about crop yields, quality, and availability</li>
                    <li>Are responsible for the quality and condition of products listed</li>
                    <li>Must honor accepted bids and fulfill orders as agreed</li>
                    <li>Should maintain proper documentation of farming practices and certifications</li>
                </ul>
            </div>

            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-3">
                <h3 class="text-lg font-semibold text-primary">4.2 Traders</h3>
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                    <li>Must submit bids in good faith with genuine intent to purchase</li>
                    <li>Are responsible for timely payment as per agreed terms</li>
                    <li>Should conduct proper due diligence before placing bids</li>
                    <li>Must maintain valid business licenses and trading permits</li>
                </ul>
            </div>
        </section>

        <!-- Trading and Transactions -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">5. Trading and Transactions</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                One Place Agro serves as a platform to facilitate connections between farmers and traders. We do not directly participate in transactions between users.
            </p>
            <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                <li>All transactions are between farmers and traders directly</li>
                <li>Users are responsible for negotiating terms, payment, and delivery</li>
                <li>We do not guarantee the quality, safety, or legality of products listed</li>
                <li>We are not responsible for disputes arising from transactions</li>
                <li>Users must comply with all applicable laws and regulations</li>
            </ul>
        </section>

        <!-- Prohibited Activities -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">6. Prohibited Activities</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                You agree not to engage in any of the following prohibited activities:
            </p>
            <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                <li>Providing false or misleading information</li>
                <li>Engaging in fraudulent activities or scams</li>
                <li>Manipulating prices or engaging in anti-competitive practices</li>
                <li>Violating any applicable laws or regulations</li>
                <li>Interfering with the proper functioning of the Service</li>
                <li>Attempting to gain unauthorized access to our systems</li>
                <li>Harassing, threatening, or abusing other users</li>
                <li>Using the Service for any illegal purpose</li>
            </ul>
        </section>

        <!-- Fees and Payments -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">7. Fees and Payments</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We may charge fees for certain features or services. Any applicable fees will be clearly disclosed before you incur them. We reserve the right to modify our fee structure with reasonable notice.
            </p>
        </section>

        <!-- Intellectual Property -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">8. Intellectual Property</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                The Service and its original content, features, and functionality are owned by One Place Agro and are protected by international copyright, trademark, patent, trade secret, and other intellectual property laws.
            </p>
        </section>

        <!-- Limitation of Liability -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">9. Limitation of Liability</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                To the maximum extent permitted by law, One Place Agro shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses.
            </p>
        </section>

        <!-- Termination -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">10. Termination</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We may terminate or suspend your account and access to the Service immediately, without prior notice or liability, for any reason, including if you breach these Terms. Upon termination, your right to use the Service will immediately cease.
            </p>
        </section>

        <!-- Governing Law -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">11. Governing Law</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                These Terms shall be governed by and construed in accordance with the laws of India, without regard to its conflict of law provisions. Any disputes arising from these Terms shall be subject to the exclusive jurisdiction of the courts in India.
            </p>
        </section>

        <!-- Changes to Terms -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">12. Changes to Terms</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We reserve the right to modify or replace these Terms at any time. We will provide notice of any material changes by posting the new Terms on this page and updating the "Last updated" date. Your continued use of the Service after such changes constitutes acceptance of the new Terms.
            </p>
        </section>

        <!-- Contact Information -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">13. Contact Us</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                If you have any questions about these Terms, please contact us at:
            </p>
            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-2">
                <p class="text-text-main-light dark:text-white font-semibold">One Place Agro</p>
                <p class="text-text-sub-light dark:text-text-sub-dark">Email: legal@oneplaceagro.com</p>
                <p class="text-text-sub-light dark:text-text-sub-dark">Phone: +91 1800-XXX-XXXX</p>
            </div>
        </section>

    </div>

    <!-- Footer -->
    <div class="sticky bottom-0 bg-surface-light dark:bg-surface-dark border-t border-gray-200 dark:border-white/10 px-6 py-4">
        <button onclick="window.history.back()" class="block w-full py-3 px-4 rounded-xl bg-gradient-to-r from-primary to-orange-400 text-white font-bold text-center shadow-lg hover:shadow-xl transition">
            Go Back
        </button>
    </div>

</div>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
@endpush
@endsection
