@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts.layoutMaster')

@section('title', 'User Dashboard')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i class="text-center primary fa-solid fa-circle-exclamation"></i>{{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-header">Chat Box</div>

                                <div class="card-body" id="chat-messages">
                                    <!-- Messages will be dynamically loaded here -->
                                </div>

                                <div class="card-footer">
                                    <form id="message-form" action="{{ route('chat.store') }}" method="post">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="content" class="form-control"
                                                placeholder="Type your message...">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Row -->
    </section><!-- End Section -->
@endsection
<script>
    // Function to fetch messages from the external API and update the chat box
    function fetchMessages() {
        $.ajax({
            url: "{{ route('fetch.messages') }}",
            type: "GET",
            success: function(response) {
                // Clear previous messages
                $('#chat-messages').empty();

                // Append new messages to the chat box
                response.forEach(function(message) {
                    $('#chat-messages').append(`
                      <div class="message">
                          <div class="message-sender">${message.sender} says:</div>
                          <div class="message-content">${message.content}</div>
                      </div>
                  `);
                });
            },
            error: function(xhr, status, error) {
                console.error("Failed to fetch messages:", error);
            }
        });
    }

    // Fetch messages when the page loads
    $(document).ready(function() {
        fetchMessages();
    });

    // Set interval to refresh messages every 30 seconds
    setInterval(fetchMessages, 30000); // Adjust refresh interval as needed
</script>
