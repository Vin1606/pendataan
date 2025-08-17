<div class="relative h-9 rounded text-center">
    <!-- Placeholder Transparan agar tinggi tetap -->
    <span class="invisible absolute">CinemaVerse aktif!</span>

    <!-- Elemen Dinamis Typewriter -->
    <div x-data="typewriterLoop(['SNACKSCREEN'])" x-init="start()" x-text="display"
        class="text-4xl text-black font-bold drop-shadow-md tracking-widest"
        style="text-shadow: 1px 1px 1px rgba(255, 0, 0, 0.9), -1px -1px 1px rgba(255, 255, 255, 0.9);">
    </div>
</div>

@push('scripts')
    <script>
        function typewriterLoop(texts) {
            return {
                display: '',
                index: 0,
                textIndex: 0,
                isDeleting: false,
                start() {
                    this.loop();
                },
                loop() {
                    const current = texts[this.textIndex];

                    if (!this.isDeleting && this.index <= current.length) {
                        this.display = current.substring(0, this.index++);
                    } else if (this.isDeleting && this.index >= 0) {
                        this.display = current.substring(0, this.index--);
                    }

                    if (this.index > current.length) {
                        this.isDeleting = true;
                        setTimeout(() => this.loop(), 2000);
                        return;
                    }

                    if (this.isDeleting && this.index < 0) {
                        this.isDeleting = false;
                        this.textIndex = (this.textIndex + 1) % texts.length;
                        setTimeout(() => this.loop(), 500);
                        return;
                    }

                    setTimeout(() => this.loop(), 90);
                }
            }
        }
    </script>
@endpush
