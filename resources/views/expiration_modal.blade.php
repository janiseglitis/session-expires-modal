<label for="expiration-modal" class="btn hidden" id="expiration-modal-open-button"></label>
<input type="checkbox" id="expiration-modal" class="modal-toggle"/>
<div class="modal">
    <div class="modal-box">

        <progress class="progress progress-primary w-100 h-3 mb-2" value="100" max="100" id="expiration-progress"></progress>

        <div class="badge badge-success badge-pill w-full p-5">
            {{ __('Remaining time') }}:
            <strong>
                <span class="px-1 countdown">
                    <span style="--value:0;" id="expiration-minutes"></span>:
                    <span style="--value:0;" id="expiration-seconds"></span>
                </span>
            </strong>
        </div>

        <div class="modal-action justify-between">
            <label class="btn" onclick="document.getElementById('logout-form').submit();">
                {{ __('End now') }}
            </label>
            <label class="btn btn-primary" onclick="window.location.href = '{{ \App\Providers\RouteServiceProvider::HOME }}'">
                {{ __('Continue to work') }}
            </label>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let countDownDate = {{ now()->addMinutes(config('session.lifetime'))->getTimestampMs() }};

        setInterval(() => countdown(), 1000);

        function countdown() {
            let now = new Date().getTime();
            let distance = countDownDate - now;
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (minutes === 1 && seconds === 0) {
                document.getElementById('expiration-modal-open-button').click();
            }

            document.getElementById('expiration-minutes').style.setProperty('--value', minutes);
            document.getElementById('expiration-seconds').style.setProperty('--value', seconds);
            document.getElementById('expiration-progress').setAttribute('value', seconds * 100 / 60);

            if (distance < 1000) {
                document.getElementById('show-expiration-message').value = 1;
                document.getElementById('logout-form').submit();
            }
        }
    </script>
@endpush
