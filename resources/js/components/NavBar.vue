<template>
    <div>
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        setup: () => ({
            label: "Nav Bar"
        }),

        props:{

        }
    }
</script>
