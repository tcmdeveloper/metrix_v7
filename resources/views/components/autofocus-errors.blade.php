<div
    x-data="{
        open: @js(request()->routeIs($route) || $hasErrors),

        field: @js($field),

        init() {
            this.$nextTick(() => {
                this.focus();
            });
        },

        focus() {
            const el = this.$refs?.[this.field];
            if (!el) return;

            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    el.focus();

                    const len = el.value?.length ?? 0;
                    el.setSelectionRange(len, len);
                });
            });
        }
    }"
    x-init="init()"
>
    {{ $slot }}
</div>

