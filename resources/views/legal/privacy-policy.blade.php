@extends('layouts.app')

@section('title', 'Privacy Policy - One Place Agro')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-background-light dark:bg-surface-dark shadow-xl overflow-y-auto min-h-screen sm:min-h-0 sm:rounded-[2rem] relative flex flex-col">
    
    <!-- Header Section -->
    <div class="sticky top-0 z-10 bg-gradient-to-r from-primary to-orange-400 px-6 py-4 shadow-lg">
        <div class="flex items-center gap-4">
            <button onclick="window.history.back()" class="text-white hover:bg-white/20 rounded-full p-2 transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </button>
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-white">Privacy Policy</h1>
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
                At One Place Agro, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our orange trading platform.
            </p>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                By using our Service, you agree to the collection and use of information in accordance with this Privacy Policy.
            </p>
        </section>

        <!-- Information We Collect -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">2. Information We Collect</h2>
            
            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-3">
                <h3 class="text-lg font-semibold text-primary">2.1 Personal Information</h3>
                <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                    When you register for an account, we collect:
                </p>
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                    <li>Full name and contact information (mobile number, email address)</li>
                    <li>Business information (farm location, trading license, GST number)</li>
                    <li>Bank account details for payment processing</li>
                    <li>Government-issued identification documents</li>
                    <li>Profile photograph</li>
                </ul>
            </div>

            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-3">
                <h3 class="text-lg font-semibold text-primary">2.2 Transaction Information</h3>
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                    <li>Details of yields listed and requirements posted</li>
                    <li>Bid information and transaction history</li>
                    <li>Payment and delivery information</li>
                    <li>Communication between farmers and traders</li>
                </ul>
            </div>

            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-3">
                <h3 class="text-lg font-semibold text-primary">2.3 Technical Information</h3>
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                    <li>Device information (type, operating system, browser)</li>
                    <li>IP address and location data</li>
                    <li>Usage data and analytics</li>
                    <li>Cookies and similar tracking technologies</li>
                </ul>
            </div>
        </section>

        <!-- How We Use Your Information -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">3. How We Use Your Information</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We use the collected information for the following purposes:
            </p>
            <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                <li><strong>Service Provision:</strong> To create and manage your account, facilitate transactions, and provide customer support</li>
                <li><strong>Verification:</strong> To verify your identity and business credentials</li>
                <li><strong>Communication:</strong> To send notifications, updates, and marketing communications</li>
                <li><strong>Improvement:</strong> To analyze usage patterns and improve our Service</li>
                <li><strong>Security:</strong> To detect and prevent fraud, abuse, and security incidents</li>
                <li><strong>Legal Compliance:</strong> To comply with legal obligations and enforce our Terms of Service</li>
                <li><strong>Market Insights:</strong> To provide market price information and agricultural news</li>
            </ul>
        </section>

        <!-- Information Sharing -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">4. Information Sharing and Disclosure</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We may share your information in the following circumstances:
            </p>
            
            <div class="space-y-3">
                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="text-lg font-semibold text-primary mb-2">4.1 With Other Users</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                        Your profile information, listings, and bids are visible to other users to facilitate transactions. We do not share your contact details without your consent.
                    </p>
                </div>

                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="text-lg font-semibold text-primary mb-2">4.2 With Service Providers</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                        We may share information with third-party service providers who assist us in operating our platform, processing payments, or providing analytics.
                    </p>
                </div>

                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="text-lg font-semibold text-primary mb-2">4.3 Legal Requirements</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                        We may disclose your information if required by law, court order, or government request, or to protect our rights and safety.
                    </p>
                </div>

                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="text-lg font-semibold text-primary mb-2">4.4 Business Transfers</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                        In the event of a merger, acquisition, or sale of assets, your information may be transferred to the acquiring entity.
                    </p>
                </div>
            </div>
        </section>

        <!-- Data Security -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">5. Data Security</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We implement appropriate technical and organizational measures to protect your personal information:
            </p>
            <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                <li>Encryption of data in transit and at rest</li>
                <li>Secure authentication and access controls</li>
                <li>Regular security audits and monitoring</li>
                <li>Employee training on data protection</li>
                <li>Incident response procedures</li>
            </ul>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed mt-3">
                However, no method of transmission over the Internet is 100% secure. While we strive to protect your information, we cannot guarantee absolute security.
            </p>
        </section>

        <!-- Data Retention -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">6. Data Retention</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We retain your personal information for as long as necessary to:
            </p>
            <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                <li>Provide our services to you</li>
                <li>Comply with legal obligations</li>
                <li>Resolve disputes and enforce agreements</li>
                <li>Maintain business records</li>
            </ul>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed mt-3">
                When you delete your account, we will delete or anonymize your personal information, except where we are required to retain it by law.
            </p>
        </section>

        <!-- Your Rights -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">7. Your Rights and Choices</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                You have the following rights regarding your personal information:
            </p>
            <div class="space-y-2">
                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="font-semibold text-text-main-light dark:text-white mb-2">Access and Correction</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        You can access and update your account information through your profile settings.
                    </p>
                </div>
                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="font-semibold text-text-main-light dark:text-white mb-2">Data Portability</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        You can request a copy of your personal data in a structured, machine-readable format.
                    </p>
                </div>
                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="font-semibold text-text-main-light dark:text-white mb-2">Deletion</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        You can request deletion of your account and personal information, subject to legal retention requirements.
                    </p>
                </div>
                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="font-semibold text-text-main-light dark:text-white mb-2">Marketing Communications</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        You can opt out of marketing communications at any time through your account settings or by clicking unsubscribe links.
                    </p>
                </div>
            </div>
        </section>

        <!-- Cookies -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">8. Cookies and Tracking Technologies</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We use cookies and similar tracking technologies to enhance your experience:
            </p>
            <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                <li><strong>Essential Cookies:</strong> Required for the platform to function properly</li>
                <li><strong>Analytics Cookies:</strong> Help us understand how users interact with our Service</li>
                <li><strong>Preference Cookies:</strong> Remember your settings and preferences</li>
                <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements</li>
            </ul>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed mt-3">
                You can control cookies through your browser settings, but disabling certain cookies may affect functionality.
            </p>
        </section>

        <!-- Children's Privacy -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">9. Children's Privacy</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                Our Service is not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If you believe we have collected information from a child, please contact us immediately.
            </p>
        </section>

        <!-- International Transfers -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">10. International Data Transfers</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                Your information may be transferred to and processed in countries other than India. We ensure appropriate safeguards are in place to protect your information in accordance with this Privacy Policy.
            </p>
        </section>

        <!-- Changes to Privacy Policy -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">11. Changes to This Privacy Policy</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the new Privacy Policy on this page and updating the "Last updated" date. We encourage you to review this Privacy Policy periodically.
            </p>
        </section>

        <!-- Contact Information -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">12. Contact Us</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                If you have any questions about this Privacy Policy or our data practices, please contact us:
            </p>
            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-2">
                <p class="text-text-main-light dark:text-white font-semibold">One Place Agro - Privacy Team</p>
                <p class="text-text-sub-light dark:text-text-sub-dark">Email: privacy@oneplaceagro.com</p>
                <p class="text-text-sub-light dark:text-text-sub-dark">Phone: +91 1800-XXX-XXXX</p>
                <p class="text-text-sub-light dark:text-text-sub-dark">Address: [Your Business Address]</p>
            </div>
        </section>

        <!-- Compliance -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">13. Legal Compliance</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                This Privacy Policy is designed to comply with applicable Indian data protection laws, including the Information Technology Act, 2000 and the Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Data or Information) Rules, 2011.
            </p>
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
