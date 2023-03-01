<x-card>
    <x-slot:header>
        <h5>Data Balik :</h5>
    </x-slot:header>
    <div wire:poll.10000ms>
        @if ($complaint->complaint_status == 0)
            <form wire:submit.prevent="send">
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="form-floating">
                            <input wire:model.defer="feedback_desc"
                                   class="form-control @error('feedback_desc') is-invalid @enderror"
                                   name="feedback_desc" autofocus="true"
                                   placeholder="Leave a comment here"
                                   id="floatingTextarea2" style="height: 100px" required>
                            <label for="floatingTextarea2">Feedback Description</label>
                        </div>
                    </div>
                    <div class="col-md-3 d-grid gab-2">
                        <button type="submit" class="btn btn-warning btn-send">
                            <i class="bi bi-send"></i> Send
                        </button>
                    </div>
                </div>
            </form>
            <hr>
        @endif
        @foreach($feedbacks as $feedback)
            <div href="#"
               class="list-group-item list-group-item-action mb-2 "
               aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $feedback->user->name }}</h5>
                    <small>{{ $feedback->created_at->diffForHumans() }}</small>
                </div>
                <p>{{ $feedback->feedback_desc }}</p>
            </div>
        @endforeach
    </div>
</x-card>
