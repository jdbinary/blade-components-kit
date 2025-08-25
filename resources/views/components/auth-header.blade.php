@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center text-primary-950 dark:text-primary-100">
    <h1 class="text-2xl">{{ $title }}</h1>
    <p class="text-sm">{{ $description }}</p>
</div>
