{{-- resources/views/auth/verify-new-email.blade.php --}}

<div class="max-w-md mx-auto text-center mt-20">

    <h1 class="text-xl font-semibold mb-4">
        Verify your new email address
    </h1>

    <p class="text-gray-600 mb-6">
        We’ve sent a verification link to your email.
    </p>

    @if (session('status') == 'verification-link-sent')
        <p class="text-green-600 mb-4">
            A new verification link has been sent.
        </p>
    @endif

    <form method="POST" action="{{ route('verification.change') }}">
        @csrf

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Resend Email
        </button>
    </form>

</div>