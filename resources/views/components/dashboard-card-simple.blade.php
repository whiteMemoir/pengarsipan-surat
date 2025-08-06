<div class="card mb-4">
    <div class="card-body d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-label-{{ $color ?? 'primary' }} p-3">
                <i class="bx {{ $icon ?? 'bx-file' }} text-{{ $color ?? 'primary' }} fs-4"></i>
            </span>
            <div>
                <div class="fw-semibold text-dark mb-1">{{ $label ?? 'Data' }}</div>
                <div class="fs-3 fw-bold mb-0">{{ $value ?? 0 }}</div>
            </div>
        </div>
        @if (!empty($link))
            <div>
                <a href="{{ $link }}" class="text-decoration-underline small">
                    Lihat {{ $label ?? 'Data' }}
                </a>
            </div>
        @endif
    </div>
</div>
