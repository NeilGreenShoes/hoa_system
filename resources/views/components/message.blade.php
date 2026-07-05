<div {{ $attributes->merge(['class' => 'message-container']) }}>
    <div class="message-content">
        {{ $slot }}
    </div>
</div>