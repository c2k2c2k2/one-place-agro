@extends('layouts.app')

@section('title', 'Content Policy - One Place Agro')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-background-light dark:bg-surface-dark shadow-xl overflow-y-auto min-h-screen sm:min-h-0 sm:rounded-[2rem] relative flex flex-col">
    
    <!-- Header Section -->
    <div class="sticky top-0 z-10 bg-gradient-to-r from-primary to-orange-400 px-6 py-4 shadow-lg">
        <div class="flex items-center gap-4">
            <button onclick="window.history.back()" class="text-white hover:bg-white/20 rounded-full p-2 transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </button>
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-white">Content Policy</h1>
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
                This Content Policy outlines the rules and guidelines for content posted on One Place Agro. Our goal is to maintain a safe, respectful, and productive environment for all farmers and traders using our platform.
            </p>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                By posting content on our platform, you agree to comply with this Content Policy. Violations may result in content removal, account suspension, or termination.
            </p>
        </section>

        <!-- Acceptable Content -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">2. Acceptable Content</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We encourage content that:
            </p>
            <div class="space-y-2">
                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="font-semibold text-secondary-green mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">check_circle</span>
                        Accurate Product Information
                    </h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        Provide truthful and accurate descriptions of orange yields, including variety, quantity, quality grade, and harvest dates.
                    </p>
                </div>
                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="font-semibold text-secondary-green mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">check_circle</span>
                        Clear Requirements
                    </h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        Post clear and specific requirements for orange purchases, including desired quality, quantity, and delivery terms.
                    </p>
                </div>
                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="font-semibold text-secondary-green mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">check_circle</span>
                        Professional Communication
                    </h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        Maintain respectful and professional communication in all interactions with other users.
                    </p>
                </div>
                <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                    <h3 class="font-semibold text-secondary-green mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">check_circle</span>
                        Authentic Images
                    </h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        Use genuine photographs of your actual products. Images should accurately represent the quality and condition of the oranges.
                    </p>
                </div>
            </div>
        </section>

        <!-- Prohibited Content -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">3. Prohibited Content</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                The following types of content are strictly prohibited on our platform:
            </p>
            
            <div class="space-y-2">
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <h3 class="font-semibold text-red-700 dark:text-red-400 mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">cancel</span>
                        False or Misleading Information
                    </h3>
                    <ul class="list-disc list-inside space-y-1 text-text-sub-light dark:text-text-sub-dark text-sm ml-4">
                        <li>Misrepresenting product quality, quantity, or origin</li>
                        <li>Using fake or misleading images</li>
                        <li>Providing false business credentials or certifications</li>
                        <li>Inflating or deflating prices artificially</li>
                    </ul>
                </div>

                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <h3 class="font-semibold text-red-700 dark:text-red-400 mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">cancel</span>
                        Illegal or Harmful Content
                    </h3>
                    <ul class="list-disc list-inside space-y-1 text-text-sub-light dark:text-text-sub-dark text-sm ml-4">
                        <li>Content promoting illegal activities</li>
                        <li>Stolen or counterfeit products</li>
                        <li>Products that violate food safety regulations</li>
                        <li>Content that infringes intellectual property rights</li>
                    </ul>
                </div>

                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <h3 class="font-semibold text-red-700 dark:text-red-400 mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">cancel</span>
                        Abusive or Harassing Content
                    </h3>
                    <ul class="list-disc list-inside space-y-1 text-text-sub-light dark:text-text-sub-dark text-sm ml-4">
                        <li>Harassment, bullying, or threats toward other users</li>
                        <li>Hate speech or discriminatory content</li>
                        <li>Personal attacks or defamatory statements</li>
                        <li>Unwanted sexual content or advances</li>
                    </ul>
                </div>

                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <h3 class="font-semibold text-red-700 dark:text-red-400 mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">cancel</span>
                        Spam and Manipulation
                    </h3>
                    <ul class="list-disc list-inside space-y-1 text-text-sub-light dark:text-text-sub-dark text-sm ml-4">
                        <li>Duplicate or repetitive listings</li>
                        <li>Fake reviews or ratings</li>
                        <li>Attempts to manipulate market prices</li>
                        <li>Unsolicited promotional content</li>
                        <li>Bot activity or automated posting</li>
                    </ul>
                </div>

                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <h3 class="font-semibold text-red-700 dark:text-red-400 mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">cancel</span>
                        Privacy Violations
                    </h3>
                    <ul class="list-disc list-inside space-y-1 text-text-sub-light dark:text-text-sub-dark text-sm ml-4">
                        <li>Sharing others' personal information without consent</li>
                        <li>Posting private communications publicly</li>
                        <li>Identity theft or impersonation</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Product Listings Guidelines -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">4. Product Listings Guidelines</h2>
            
            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-3">
                <h3 class="text-lg font-semibold text-primary">4.1 Yield Listings (Farmers)</h3>
                <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                    When listing your orange yields, you must:
                </p>
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark text-sm ml-4">
                    <li>Specify the orange variety accurately (e.g., Valencia, Navel, Blood Orange)</li>
                    <li>Provide accurate quantity in standard units (kg, quintals, tons)</li>
                    <li>Indicate quality grade honestly (Premium, Grade A, Grade B, etc.)</li>
                    <li>State the expected harvest or availability date</li>
                    <li>Include clear, recent photographs of the actual product</li>
                    <li>Mention any certifications (organic, FPO, etc.)</li>
                    <li>Specify location and delivery options</li>
                    <li>Set realistic and fair pricing</li>
                </ul>
            </div>

            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-3">
                <h3 class="text-lg font-semibold text-primary">4.2 Requirement Postings (Traders)</h3>
                <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                    When posting requirements, you must:
                </p>
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark text-sm ml-4">
                    <li>Clearly specify the orange variety needed</li>
                    <li>State the required quantity and quality standards</li>
                    <li>Provide realistic delivery timelines</li>
                    <li>Indicate your location and preferred delivery areas</li>
                    <li>Specify payment terms clearly</li>
                    <li>Be transparent about any special requirements</li>
                </ul>
            </div>
        </section>

        <!-- Image Guidelines -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">5. Image and Media Guidelines</h2>
            <div class="space-y-3">
                <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                    All images and media uploaded to the platform must:
                </p>
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                    <li>Be your own original content or properly licensed</li>
                    <li>Accurately represent the product being sold</li>
                    <li>Be clear, well-lit, and of reasonable quality</li>
                    <li>Not contain watermarks from other platforms</li>
                    <li>Not include inappropriate or offensive content</li>
                    <li>Not contain personal information of others</li>
                    <li>Be recent and reflect current product condition</li>
                </ul>
            </div>
        </section>

        <!-- Communication Standards -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">6. Communication Standards</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                When communicating with other users:
            </p>
            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4">
                <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark">
                    <li>Be respectful and professional at all times</li>
                    <li>Respond to inquiries and bids in a timely manner</li>
                    <li>Communicate clearly about terms and conditions</li>
                    <li>Honor commitments made during negotiations</li>
                    <li>Report any suspicious or inappropriate behavior</li>
                    <li>Keep business discussions on the platform when possible</li>
                    <li>Avoid sharing personal contact information publicly</li>
                </ul>
            </div>
        </section>

        <!-- Reporting Violations -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">7. Reporting Violations</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                If you encounter content that violates this policy:
            </p>
            <div class="bg-primary/10 dark:bg-primary/20 border border-primary/30 rounded-xl p-4 space-y-3">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-primary text-2xl">report</span>
                    <div class="flex-1">
                        <h3 class="font-semibold text-text-main-light dark:text-white mb-2">How to Report</h3>
                        <ul class="list-disc list-inside space-y-1 text-text-sub-light dark:text-text-sub-dark text-sm ml-4">
                            <li>Use the "Report" button on any listing or profile</li>
                            <li>Provide specific details about the violation</li>
                            <li>Include screenshots or evidence if available</li>
                            <li>Contact our support team at support@oneplaceagro.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We review all reports promptly and take appropriate action. False reports may result in penalties.
            </p>
        </section>

        <!-- Enforcement -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">8. Enforcement and Penalties</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                Violations of this Content Policy may result in:
            </p>
            <div class="space-y-2">
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4">
                    <h3 class="font-semibold text-yellow-700 dark:text-yellow-400 mb-2">Warning</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        First-time minor violations may receive a warning with guidance on policy compliance.
                    </p>
                </div>
                <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-xl p-4">
                    <h3 class="font-semibold text-orange-700 dark:text-orange-400 mb-2">Content Removal</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        Violating content will be removed from the platform immediately.
                    </p>
                </div>
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <h3 class="font-semibold text-red-700 dark:text-red-400 mb-2">Account Suspension</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        Repeated or serious violations may result in temporary account suspension.
                    </p>
                </div>
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <h3 class="font-semibold text-red-700 dark:text-red-400 mb-2">Permanent Ban</h3>
                    <p class="text-text-sub-light dark:text-text-sub-dark text-sm">
                        Severe violations, fraud, or repeated offenses may result in permanent account termination.
                    </p>
                </div>
            </div>
        </section>

        <!-- Appeals -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">9. Appeals Process</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                If you believe your content was removed or your account was penalized in error, you may appeal by:
            </p>
            <ul class="list-disc list-inside space-y-2 text-text-sub-light dark:text-text-sub-dark ml-4">
                <li>Contacting our support team within 7 days of the action</li>
                <li>Providing a detailed explanation of why you believe the action was incorrect</li>
                <li>Including any supporting evidence or documentation</li>
            </ul>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed mt-3">
                We will review appeals fairly and respond within 5-7 business days.
            </p>
        </section>

        <!-- Updates to Policy -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">10. Updates to This Policy</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                We may update this Content Policy from time to time to reflect changes in our practices or legal requirements. Continued use of the platform after updates constitutes acceptance of the revised policy.
            </p>
        </section>

        <!-- Contact -->
        <section class="space-y-3">
            <h2 class="text-xl font-bold text-text-main-light dark:text-white">11. Contact Us</h2>
            <p class="text-text-sub-light dark:text-text-sub-dark leading-relaxed">
                For questions about this Content Policy or to report violations:
            </p>
            <div class="bg-surface-light dark:bg-background-dark rounded-xl p-4 space-y-2">
                <p class="text-text-main-light dark:text-white font-semibold">One Place Agro - Content Moderation Team</p>
                <p class="text-text-sub-light dark:text-text-sub-dark">Email: content@oneplaceagro.com</p>
                <p class="text-text-sub-light dark:text-text-sub-dark">Support: support@oneplaceagro.com</p>
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
