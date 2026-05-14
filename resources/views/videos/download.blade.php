<x-layout.template :pageHeadings="$pageHeadings">

    <div class="form-card">
        <form method="POST" action="{{ url('videos/download/submit') }}">
            @csrf

            <div class="form-field">
                <label>YouTube Video URL</label>
            
                <input
                    type="text"
                    name="url"
                    value="{{ old('url') }}"
                >

                @error('url')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-field">
                <label>File name</label>
            
                <input
                    type="text"
                    name="fileName"
                    value="{{ old('fileName') }}"
                >

                @error('fileName')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn">
                    Download
                </button>
            </div>
        </form>
    </div>



</x-layout.template>