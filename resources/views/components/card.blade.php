<div {{ $attributes -> merge(['class' => 'card']) }}>
    <div class="card-body flex flex-col gap-6">
        {{ $slot }}
    </div>
</div>
