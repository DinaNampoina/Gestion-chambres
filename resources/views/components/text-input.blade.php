@props(['disabled' => false])
<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm w-full']) }}>
