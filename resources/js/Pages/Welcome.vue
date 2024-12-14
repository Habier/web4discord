<script setup>

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');

body {
    height: 100vh;
    overflow: hidden;
    background-color: #000;
    display: flex;
    align-items: center;
    justify-content: center;
}

a {
    color: green;
    font-family: 'Share Tech Mono', 'Cascadia Code', Menlo, Monaco, 'Courier New', monospace;
    font-size: 6rem;
    filter: drop-shadow(0px 0px 5px currentColor);

    &::after {
        content: '';
        display: inline-block;
        width: .2em;
        height: .7em;
        background-color: currentColor;
        margin-left: .1em;
        animation: blink 1s linear infinite forwards;
        vertical-align: baseline;
    }
}

.grid-container {
    --grid: 10rem;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    transform-style: preserve-3d;
    perspective: 100rem;
    animation: rotate 100s linear infinite forwards;

    .plane {
        --dir: 1;
        width: 300%;
        height: 150%;
        min-height: 70rem;
        position: absolute;
        bottom: 0;
        transform-style: preserve-3d;
        transform-origin: bottom center;
        transform: translateX(-50%) rotateX(85deg);

        &:last-child {
            --dir: -1;
            top: 0;
            transform-origin: top center;
            transform: translateX(-50%) rotateX(-85deg);

            & > * {
                &::after {
                    background-image: linear-gradient(to top, rgba(0, 0, 0, 255) var(--grid), rgba(0, 0, 0, 0));
                }
            }
        }

        & > * {
            transform-style: preserve-3d;
            height: 100%;
            width: 100%;
            position: absolute;

            &::before, &::after {
                content: '';
                display: block;
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
            }

            &::before {
                background-image: repeating-linear-gradient(to left, green, green 4px, transparent 4px, transparent var(--grid)),
                repeating-linear-gradient(to bottom, green, green 4px, transparent 4px, transparent var(--grid));
                animation: move 1s linear infinite forwards;
            }

            &::after {
                background-image: linear-gradient(to bottom, rgba(0, 0, 0, 255) var(--grid), rgba(0, 0, 0, 0));
                z-index: 1;
                transform: translateZ(1px);
            }
        }

        .glow {
            filter: blur(1rem);
            z-index: 1;
            mix-blend-mode: plus-lighter;
        }
    }
}

@keyframes move {
    from {
        transform: translateY(0px);
    }

    to {
        transform: translateY(calc(var(--grid) * var(--dir)));
    }
}

@keyframes blink {
    0% {
        visibility: visible;
    }

    50% {
        visibility: visible;
    }

    51% {
        visibility: hidden;
    }

    100% {
        visibility: hidden;
    }
}
</style>

<template>
    <div class="grid-container">
        <div class="plane">
            <div class="grid"></div>
            <div class="glow"></div>
        </div>
        <div class="plane">
            <div class="grid"></div>
            <div class="glow"></div>
        </div>
    </div>

    <a :href="route('login')">Enter</a>
</template>
