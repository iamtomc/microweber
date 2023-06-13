<div>

    <div class="d-flex justify-content-between">
        <div>
        <h2>{{_e('Comments')}}</h2>
        <p>
            {{_e('View, reply to, and manage all the comments across your site.')}}
        </p>
        </div>
        <div class="mt-2">
            <button onclick="Livewire.emit('openModal', 'comments::admin.settings-modal')" class="btn btn-link tblr-body-color font-weight-bold text-decoration-none me-3 fs-3 mw-admin-action-links" href="{{admin_url('settings?group=general')}}">
                <svg fill="currentColor" class="me-1" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="m388-80-20-126q-19-7-40-19t-37-25l-118 54-93-164 108-79q-2-9-2.5-20.5T185-480q0-9 .5-20.5T188-521L80-600l93-164 118 54q16-13 37-25t40-18l20-127h184l20 126q19 7 40.5 18.5T669-710l118-54 93 164-108 77q2 10 2.5 21.5t.5 21.5q0 10-.5 21t-2.5 21l108 78-93 164-118-54q-16 13-36.5 25.5T592-206L572-80H388Zm92-270q54 0 92-38t38-92q0-54-38-92t-92-38q-54 0-92 38t-38 92q0 54 38 92t92 38Zm0-60q-29 0-49.5-20.5T410-480q0-29 20.5-49.5T480-550q29 0 49.5 20.5T550-480q0 29-20.5 49.5T480-410Zm0-70Zm-44 340h88l14-112q33-8 62.5-25t53.5-41l106 46 40-72-94-69q4-17 6.5-33.5T715-480q0-17-2-33.5t-7-33.5l94-69-40-72-106 46q-23-26-52-43.5T538-708l-14-112h-88l-14 112q-34 7-63.5 24T306-642l-106-46-40 72 94 69q-4 17-6.5 33.5T245-480q0 17 2.5 33.5T254-413l-94 69 40 72 106-46q24 24 53.5 41t62.5 25l14 112Z"/></svg>
                {{_e('Settings')}}
            </button>
        </div>
    </div>

    <div class="d-flex mb-3 mt-4 gap-3">
        <div class="btn-group w-100" role="group">
            <input type="radio" wire:model="filter.status" value="all" class="btn-check" name="btn-radio-filter-status" id="btn-radio-basic-1" autocomplete="off">
            <label for="btn-radio-basic-1" type="button" class="btn">{{_e('All')}} <span class="badge badge-primary mx-2">{{$countAll}}</span></label>

            <input type="radio" wire:model="filter.status" value="pending" class="btn-check" name="btn-radio-filter-status" id="btn-radio-basic-3" autocomplete="off">
            <label for="btn-radio-basic-3" type="button" class="btn">{{_e('Pending')}} <span class="badge badge-primary mx-2">{{$countPending}}</span></label>

            <input type="radio" wire:model="filter.status" value="approved" class="btn-check" name="btn-radio-filter-status" id="btn-radio-basic-4" autocomplete="off">
            <label for="btn-radio-basic-4" type="button" class="btn">{{_e('Approved')}} <span class="badge badge-primary mx-2">{{$countApproved}}</span></label>

            <input type="radio" wire:model="filter.status" value="spam" class="btn-check" name="btn-radio-filter-status" id="btn-radio-basic-5" autocomplete="off">
            <label for="btn-radio-basic-5" type="button" class="btn">{{_e('Spam')}} <span class="badge badge-primary mx-2">{{$countSpam}}</span></label>

            <input type="radio" wire:model="filter.status" value="trash" class="btn-check" name="btn-radio-filter-status" id="btn-radio-basic-6" autocomplete="off">
            <label for="btn-radio-basic-6" type="button" class="btn">{{_e('Trash')}} <span class="badge badge-primary mx-2">{{$countTrashed}}</span></label>
        </div>

        <div>
            <div class="btn-group w-100" role="group">
                <input type="radio" wire:model="orderBy" value="newest" class="btn-check" name="btn-radio-order-by" id="btn-radio-basic-8" autocomplete="off">
                <label for="btn-radio-basic-8" type="button" class="btn">{{_e('Newest')}} </label>

                <input type="radio" wire:model="orderBy" value="oldest" class="btn-check" name="btn-radio-order-by" id="btn-radio-basic-9" autocomplete="off">
                <label for="btn-radio-basic-9" type="button" class="btn">{{_e('Oldest')}} </label>
            </div>
        </div>

    </div>


    <div>

        @if($comments->count() > 0)
            <div class="mb-4 mt-2">
                <div class="input-icon">
                  <span class="input-icon-addon">
                      <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960"
                           width="24"><path
                              d="M796 935 533 672q-30 26-69.959 40.5T378 727q-108.162 0-183.081-75Q120 577 120 471t75-181q75-75 181.5-75t181 75Q632 365 632 471.15 632 514 618 554q-14 40-42 75l264 262-44 44ZM377 667q81.25 0 138.125-57.5T572 471q0-81-56.875-138.5T377 275q-82.083 0-139.542 57.5Q180 390 180 471t57.458 138.5Q294.917 667 377 667Z"/></svg>
                  </span>
                    <input type="text" class="form-control form-control-sm" placeholder="Search..."
                           wire:model="filter.keyword" />
                    <div wire:loading wire:target="filter.keyword" class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">{{  _e("Searching")}}...</span>
                    </div>
                </div>
            </div>
        @endif

        @foreach($comments as $comment)

            <div class="card shadow-sm mb-4 bg-silver comments-card" x-data="{showReplyForm: false}">

                @if($comment->isPending())
                <div class="card-status-start bg-primary"></div>
                @endif

                <div class="card-body">
                    <div class="gap-5">

                        <div class="d-flex align-items-center gap-2">

                            <div>
                                @if($comment->created_by > 0)
                                    <img class="rounded-circle shadow-1-strong me-3"
                                         src="{{user_picture($comment->created_by)}}" alt="avatar" width="65"
                                         height="65" />
                                @else
                                    <div class="shadow-1-strong me-3">
                                        <i class="fa fa-user-circle-o" style="font-size:42px"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between gap-5" style="width: 100%;">
                                <div class="">
                                    <p class="mb-0">
                                        {{$comment->comment_name}}
                                    </p>
                                    <span class="text-muted">
                                        {{$comment->created_at->diffForHumans()}}
                                        <span>·</span>
                                     {{$comment->comment_email}}
                                    </span>
                                </div>

                                @if($comment->isPending())
                                    <div>
                                        <span class="badge badge-primary bg-primary">
                                         {{_e('Waiting for approval')}}
                                        </span>
                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="mt-3" style="padding-left:80px">

                            <div class="cursor-pointer" wire:click="filterByContentId('{{$comment->contentId()}}')">
                                <p class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M16 19H3v-2h13v2zm5-10H3v2h18V9zM3 5v2h11V5H3zm14 0v2h4V5h-4zm-6 8v2h10v-2H11zm-8 0v2h5v-2H3z"/></svg>
                                {{$comment->contentTitle()}}
                                </p>
                            </div>

                            @if($comment->reply_to_comment_id > 0)
                            <div class="mb-2">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                        {{_e('In reply to:')}}
                                        <span class="text-muted">
                                       {{str_limit($comment->parentCommentBody(), 80)}}
                                      </span>
                                    </a>
                                </div>
                            </div>
                            @endif

                            <div class="cursor-pointer" wire:click="preview({{$comment->id}})">
                               <span class="mb-0 text-bold">
                                  {!! $comment->comment_body !!}
                                </span>
                            </div>
                        </div>

                        <div style="padding-left:80px">
                            <div class="border-top pt-3 mt-3 d-flex gap-4">


                                @if($comment->deleted_at == null)
                                    @if ($comment->is_moderated == 1)
                                        <button class="mw-admin-action-links text-decoration-none btn btn-link" wire:click="markAsUnmoderated('{{$comment->id}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 40 40"><path fill="currentColor" d="M21.499 19.994L32.755 8.727a1.064 1.064 0 0 0-.001-1.502c-.398-.396-1.099-.398-1.501.002L20 18.494L8.743 7.224c-.4-.395-1.101-.393-1.499.002a1.05 1.05 0 0 0-.309.751c0 .284.11.55.309.747L18.5 19.993L7.245 31.263a1.064 1.064 0 0 0 .003 1.503c.193.191.466.301.748.301h.006c.283-.001.556-.112.745-.305L20 21.495l11.257 11.27c.199.198.465.308.747.308a1.058 1.058 0 0 0 1.061-1.061c0-.283-.11-.55-.31-.747L21.499 19.994z"/></svg>
                                            {{ _e("Unapprove") }}
                                        </button>
                                    @else
                                        <button class="mw-admin-action-links text-decoration-none btn btn-link text-success" wire:click="markAsModerated('{{$comment->id}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256"><path fill="currentColor" d="m232.49 80.49l-128 128a12 12 0 0 1-17 0l-56-56a12 12 0 1 1 17-17L96 183L215.51 63.51a12 12 0 0 1 17 17Z"/></svg>
                                            {{ _e("Approve") }}
                                        </button>
                                    @endif

                                    @if($comment->is_spam == 1)
                                        <button class="mw-admin-action-links text-decoration-none btn btn-link" wire:click="markAsNotSpam('{{$comment->id}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M17.5 2.5L23 12l-5.5 9.5h-11L1 12l5.5-9.5h11Zm-1.153 2H7.653L3.311 12l4.342 7.5h8.694l4.342-7.5l-4.342-7.5ZM11 15h2v2h-2v-2Zm0-8h2v6h-2V7Z"/></svg>
                                            &nbsp;{{ _e("Unspam") }}
                                        </button>
                                    @else
                                        <button class="mw-admin-action-links text-decoration-none btn btn-link" wire:click="markAsSpam('{{$comment->id}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M17.5 2.5L23 12l-5.5 9.5h-11L1 12l5.5-9.5h11Zm-1.153 2H7.653L3.311 12l4.342 7.5h8.694l4.342-7.5l-4.342-7.5ZM11 15h2v2h-2v-2Zm0-8h2v6h-2V7Z"/></svg>
                                           &nbsp;{{ _e("Spam") }}
                                        </button>
                                    @endif
                                @endif

                                @if($comment->deleted_at !== null)
                                    <button class="mw-admin-action-links text-decoration-none btn btn-link" wire:click="markAsNotTrash('{{$comment->id}}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 1024 1024"><path fill="currentColor" d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"/></svg>
                                        {{ _e("Untrash") }}
                                    </button>

                                    @php
                                        $deleteModalData = [
                                            'body' => 'Are you sure you want to delete this comment?',
                                            'title' => 'Delete this comment',
                                            'button_text'=> 'Delete forever',
                                            'action' => 'executeCommentDelete',
                                            'data'=> $comment->id
                                        ];
                                    @endphp
                                    <button class="mw-admin-action-links text-decoration-none btn btn-link"
                                            onclick="Livewire.emit('openModal', 'admin-confirm-modal', {{ json_encode($deleteModalData) }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z"/><path fill="currentColor" d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z"/></svg>
                                        {{ _e("Delete forever") }}
                                    </button>
                                @else


                                    @php
                                        $trashModalData = [
                                            'body' => 'Are you sure you want to trash this comment?',
                                            'title' => 'Trash this comment',
                                            'button_text'=> 'Move to trash',
                                            'action' => 'executeCommentMarkAsTrash',
                                            'data'=> $comment->id
                                        ];
                                    @endphp
                                    <button class="mw-admin-action-links text-decoration-none btn btn-link"
                                            onclick="Livewire.emit('openModal', 'admin-confirm-modal', {{ json_encode($trashModalData) }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z"/><path fill="currentColor" d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z"/></svg>
                                        {{ _e("Trash") }}
                                    </button>
                                @endif

                                @if($comment->deleted_at == null)
                                <button class="mw-admin-action-links text-decoration-none btn btn-link" wire:click="edit('{{$comment->id}}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256"><path fill="currentColor" d="M224.49 76.2L179.8 31.51a12 12 0 0 0-17 0L39.52 154.83a11.9 11.9 0 0 0-3.52 8.48V208a12 12 0 0 0 12 12h44.69a12 12 0 0 0 8.48-3.51L224.48 93.17a12 12 0 0 0 0-17ZM45.66 160L136 69.65L158.34 92L68 182.34ZM44 208v-38.34l21.17 21.17L86.34 212H48a4 4 0 0 1-4-4Zm52 2.34L73.66 188L164 97.65L186.34 120ZM218.83 87.51L192 114.34L141.66 64l26.82-26.83a4 4 0 0 1 5.66 0l44.69 44.68a4 4 0 0 1 0 5.66Z"/></svg>
                                    &nbsp;{{ _e("Edit") }}
                                </button>

                                <button @click="showReplyForm = ! showReplyForm" style="cursor:pointer" class="mw-admin-action-links text-decoration-none btn btn-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M9 16h7.2l-2.6 2.6L15 20l5-5l-5-5l-1.4 1.4l2.6 2.6H9c-2.2 0-4-1.8-4-4s1.8-4 4-4h2V4H9c-3.3 0-6 2.7-6 6s2.7 6 6 6z"/></svg>
                                    {{ _e("Reply") }}
                                </button>

                                @endif

                            </div>

                            @if($comment->deleted_at == null)
                                <div x-show="showReplyForm" style="display:none; background:#fff;" >
                                    <div class="mt-2 mb-4">
                                        <div>
                                            <livewire:comments::admin-comment-reply wire:key="admin-comment-reply-id-{{$comment->id}}" rel_id="{{$comment->rel_id}}" reply_to_comment_id="{{$comment->id}}" />
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        @endforeach

        @if($comments->count() == 0)
            <div class="mt-6 mb-6">
                <div class="text-center">
                <svg id="afc94e65-7c1f-4867-a63c-c1fee2c1d6cd" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="365.76" height="282.89" viewBox="0 0 865.76 682.89"><defs><clipPath id="f73d28a1-ee4f-4984-ae5d-2ffedea9ba65"><path id="e383aa6d-f02c-48b4-b062-5333539364d6" data-name="SVGID" d="M122.49,357h312.9a0,0,0,0,1,0,0v5.84a7.57,7.57,0,0,1-7.57,7.57H131.56a9.07,9.07,0,0,1-9.07-9.07V357A0,0,0,0,1,122.49,357Z" fill="#2f2e41"/></clipPath><clipPath id="f623eb5e-f18c-429b-af18-05fa04b96e87"><path id="b799e3e0-c779-4d06-a570-3d104b574893" data-name="SVGID" d="M122.49,357h312.9a0,0,0,0,1,0,0v5.84a7.57,7.57,0,0,1-7.57,7.57H131.56a9.07,9.07,0,0,1-9.07-9.07V357A0,0,0,0,1,122.49,357Z" fill="#231f20"/></clipPath></defs><polygon points="109.69 399.2 48.18 589.62 63.44 589.62 124.45 399.2 184.97 589.62 199.24 589.62 139.21 399.2 109.69 399.2" fill="#ccc"/><polygon points="171.19 532.55 75.74 532.55 71.8 546.82 176.61 546.82 171.19 532.55" fill="#ccc"/><rect x="406.49" y="384.93" width="64.95" height="14.27" fill="#ccc"/><rect x="406.49" y="392.07" width="64.95" height="7.13" fill="#231f20" opacity="0.2"/><polygon points="424.2 399.2 362.7 589.62 377.96 589.62 438.97 399.2 499.49 589.62 513.76 589.62 453.73 399.2 424.2 399.2" fill="#ccc"/><polygon points="485.71 532.55 390.25 532.55 386.32 546.82 491.12 546.82 485.71 532.55" fill="#ccc"/><rect x="91.97" y="384.93" width="64.95" height="14.27" fill="#ccc"/><rect x="91.97" y="392.07" width="64.95" height="7.13" fill="#231f20" opacity="0.2"/><rect x="17.55" y="370.85" width="527.57" height="14.08" rx="6.01" fill="#ccc"/><rect x="17.55" y="370.85" width="527.57" height="14.08" rx="6.01" fill="#231f20" opacity="0.2"/><path d="M145.27,325.87s-1-1.39-2.74-3.42l.56-.48a43.45,43.45,0,0,1,2.79,3.48Z" fill="#2f2e41"/><path d="M100.17,321.49a15.39,15.39,0,0,1-1.8-.1l.08-.73a16.63,16.63,0,0,0,2.45.08,26.57,26.57,0,0,0,6-.94l.2.71a28,28,0,0,1-6.14,1Zm-9.8-3.65a5.92,5.92,0,0,1-1.86-4.24,8,8,0,0,1,1.12-3.85c.05-.1.11-.19.17-.29l.63.37c-.05.1-.11.19-.16.28a7.27,7.27,0,0,0-1,3.49,5.18,5.18,0,0,0,1.64,3.72Zm24.54-1.23-.45-.58a20.64,20.64,0,0,0,5.39-6.5l.65.35A21.36,21.36,0,0,1,114.91,316.61Zm21.57-.27a61.8,61.8,0,0,0-6.82-5.25l.4-.61a60.22,60.22,0,0,1,6.9,5.31ZM122.11,307a40.86,40.86,0,0,0-8.16-2.6l.15-.73a42.38,42.38,0,0,1,8.31,2.65ZM97,304.9l-.21-.71.46-.12a38.32,38.32,0,0,1,8.18-1.16l0,.74a37.54,37.54,0,0,0-8,1.13Z" fill="#2f2e41"/><path d="M123.35,301.57l-.72-.14a43.71,43.71,0,0,0,.59-4.34l.73.06A42.47,42.47,0,0,1,123.35,301.57Z" fill="#2f2e41"/><path d="M113.55,244.11s-.57-1.57-1.34-4.24l.71-.21c.77,2.65,1.32,4.18,1.33,4.2Z" fill="#2f2e41"/><path d="M110,231.09c-.64-3-1.18-6-1.61-8.91l.73-.11c.43,3,1,5.93,1.6,8.87Zm-2.59-17.91c-.2-2.72-.3-5.43-.3-8,0-.34,0-.68,0-1h.74c0,.34,0,.67,0,1,0,2.6.1,5.28.29,8Zm1-18-.74-.08a81.14,81.14,0,0,1,1.43-8.95l.72.15A79.89,79.89,0,0,0,108.36,195.15Zm3.85-17.51-.69-.25a62.66,62.66,0,0,1,3.63-8.31l.65.34A64,64,0,0,0,112.21,177.64ZM214,168.81a80.5,80.5,0,0,0-3.8-8.13l.65-.35a83.29,83.29,0,0,1,3.84,8.21Zm-93.4-7-.59-.44a57.7,57.7,0,0,1,6-6.81l.52.53A56.26,56.26,0,0,0,120.58,161.84Zm84.81-8.74a49.49,49.49,0,0,0-5.93-6.7l.51-.53a51,51,0,0,1,6,6.79Zm-72-3.71-.43-.6a66.66,66.66,0,0,1,7.73-4.73l.34.66A65.09,65.09,0,0,0,133.39,149.39ZM149.22,141l-.26-.69c2.6-1,5.36-1.9,8.21-2.69l.36-.14.26.69-.37.15C154.55,139.16,151.81,140.05,149.22,141Zm43.12,0a38.06,38.06,0,0,0-8.16-3.61l.22-.71a38.31,38.31,0,0,1,8.31,3.69Zm-25.87-4.93-.1-.73a44.1,44.1,0,0,1,9.09-.31l-.05.73A44,44,0,0,0,166.47,136.1Z" fill="#2f2e41"/><path d="M218.22,181.63c-.38-1.44-.79-2.86-1.21-4.24l.7-.22c.43,1.39.84,2.83,1.22,4.27Z" fill="#2f2e41"/><path d="M412.84,252.92l-.15-.72s1.63-.33,4.29-1l.18.72C414.48,252.59,412.85,252.92,412.84,252.92Z" fill="#2f2e41"/><path d="M425.24,249.61l-.22-.7c2.69-.84,5.36-1.75,7.93-2.7l.26.69C430.62,247.86,428,248.77,425.24,249.61ZM441,243.76l-.3-.68c2.63-1.15,5.17-2.36,7.54-3.61l.35.65C446.2,241.38,443.65,242.6,441,243.76Zm7.76-1.51c0-1,0-1.94,0-2.88,0-1.88,0-3.74.09-5.52l.74,0c-.06,1.77-.09,3.62-.09,5.49,0,.94,0,1.89,0,2.87Zm7.11-6.35-.4-.62a73.53,73.53,0,0,0,6.76-4.88l.47.57A73.18,73.18,0,0,1,455.88,235.9Zm-5.73-10.36-.74-.07c.31-2.95.73-5.75,1.24-8.32l.73.15C450.86,219.84,450.45,222.62,450.15,225.54Zm18.69-.37-.55-.49a41,41,0,0,0,4.92-6.68l.63.38A41.21,41.21,0,0,1,468.84,225.17Zm8.31-14.58-.72-.18a14.12,14.12,0,0,0,.45-3.53,13.75,13.75,0,0,0-.76-4.52l.69-.24a14.08,14.08,0,0,1,.81,4.76A15.09,15.09,0,0,1,477.15,210.59Zm-23.6-1.32-.7-.25a34,34,0,0,1,3.71-7.59l.61.42A32.67,32.67,0,0,0,453.55,209.27Zm9.71-12.64-.28-.69a14,14,0,0,1,4.93-1.07,8.35,8.35,0,0,1,3.5.74l-.31.67a7.69,7.69,0,0,0-3.19-.67h0A12.35,12.35,0,0,0,463.26,196.63Z" fill="#2f2e41"/><path d="M449.39,255.12c-.12-1.51-.21-3-.3-4.42l.74,0q.12,2.15.3,4.41Z" fill="#2f2e41"/><path d="M412.84,344.14l-.15-.72a33,33,0,0,0,4.17-1.29l.26.69A29.67,29.67,0,0,1,412.84,344.14Z" fill="#2f2e41"/><path d="M424.87,339l-.38-.63a45.17,45.17,0,0,0,6.79-5.11l.49.54A44.37,44.37,0,0,1,424.87,339Zm12.64-11.66-.59-.43a41.7,41.7,0,0,0,4.24-7.35l.68.31A43.16,43.16,0,0,1,437.51,327.36Z" fill="#2f2e41"/><path d="M444.66,311.72l-.71-.18c.34-1.4.64-2.85.88-4.31l.73.12C445.32,308.83,445,310.3,444.66,311.72Z" fill="#2f2e41"/><path d="M153.83,181.09H404.68a8,8,0,0,1,8,8V356.86a0,0,0,0,1,0,0H145.81a0,0,0,0,1,0,0V189.11A8,8,0,0,1,153.83,181.09Z" fill="#2f2e41"/><rect x="159.61" y="192.3" width="239.58" height="153.95" fill="#fff"/><path d="M294,304.74h85.59a7.43,7.43,0,0,1,7.43,7.43v34a0,0,0,0,1,0,0H286.56a0,0,0,0,1,0,0v-34A7.43,7.43,0,0,1,294,304.74Z" fill="#ccc"/><rect x="295.6" y="312.55" width="82.36" height="5.62" opacity="0.2"/><rect x="295.6" y="323.46" width="82.36" height="5.62" opacity="0.2"/><rect x="295.6" y="334.38" width="45.23" height="5.62" opacity="0.2"/><rect x="159.61" y="192.3" width="239.58" height="96.08" fill="#ccc"/><path d="M402.61,173.34v36.87a8,8,0,0,1-8,8H300.83l-19.56,14.11,6-14.11H269.88a8,8,0,0,1-8-8V173.34a8,8,0,0,1,8-8H394.64A8,8,0,0,1,402.61,173.34Z" fill="#2f2e41"/><path d="M402.61,173.34v36.87a8,8,0,0,1-8,8H300.83l-19.56,14.11,6-14.11H269.88a8,8,0,0,1-8-8V173.34a8,8,0,0,1,8-8H394.64A8,8,0,0,1,402.61,173.34Z" opacity="0.2"/><circle cx="291.03" cy="191.21" r="18.56" fill="#fff"/><path d="M276.25,202.48s14.14-8.57,29.82-.42a17.65,17.65,0,0,1-15,7.68S283.12,211,276.25,202.48Z" fill="#2f2e41"/><rect x="318.95" y="177.56" width="28.08" height="2.11" fill="#fff"/><rect x="318.83" y="199.9" width="69.61" height="1.99" fill="#fff"/><rect x="318.83" y="205.05" width="42.82" height="2.22" fill="#fff"/><polygon points="322.53 184.94 324.08 188.07 327.53 188.57 325.03 191.01 325.62 194.45 322.53 192.83 319.44 194.45 320.03 191.01 317.53 188.57 320.99 188.07 322.53 184.94" fill="#fff"/><polygon points="335.17 184.94 336.71 188.07 340.17 188.57 337.67 191.01 338.26 194.45 335.17 192.83 332.07 194.45 332.67 191.01 330.17 188.57 333.62 188.07 335.17 184.94" fill="#fff"/><polygon points="347.68 185.18 349.23 188.31 352.68 188.81 350.18 191.25 350.77 194.69 347.68 193.06 344.59 194.69 345.18 191.25 342.68 188.81 346.14 188.31 347.68 185.18" fill="#fff"/><polygon points="360.32 184.82 361.86 187.96 365.32 188.46 362.82 190.89 363.41 194.34 360.32 192.71 357.23 194.34 357.82 190.89 355.32 188.46 358.77 187.96 360.32 184.82" fill="#fff"/><polygon points="372.83 185.06 374.38 188.19 377.83 188.69 375.33 191.13 375.93 194.57 372.83 192.94 369.74 194.57 370.33 191.13 367.83 188.69 371.29 188.19 372.83 185.06" fill="#fff"/><path d="M463.76,258.13V304.9a3,3,0,0,1-3,3H361.17L342.1,321.67l5.84-13.75H326.08a3,3,0,0,1-3-3V258.13a3,3,0,0,1,3-3H460.74A3,3,0,0,1,463.76,258.13Z" fill="#2f2e41"/><path d="M463.76,258.13V304.9a3,3,0,0,1-3,3H361.17L342.1,321.67l5.84-13.75H326.08a3,3,0,0,1-3-3V258.13a3,3,0,0,1,3-3H460.74A3,3,0,0,1,463.76,258.13Z" opacity="0.2"/><circle cx="351.86" cy="280.58" r="18.56" fill="#fff"/><path d="M336.89,291.61s14.45-8.78,30.13-.37c0,0-4.37,7.85-15.16,7.9C351.86,299.14,343.75,300.36,336.89,291.61Z" fill="#2f2e41"/><rect x="379.78" y="266.93" width="28.08" height="2.11" fill="#fff"/><rect x="379.66" y="289.28" width="69.61" height="1.99" fill="#fff"/><rect x="379.66" y="294.43" width="42.82" height="2.22" fill="#fff"/><polygon points="383.36 274.32 384.91 277.45 388.36 277.95 385.86 280.39 386.45 283.83 383.36 282.2 380.27 283.83 380.86 280.39 378.36 277.95 381.82 277.45 383.36 274.32" fill="#fff"/><polygon points="396 274.32 397.54 277.45 401 277.95 398.5 280.39 399.09 283.83 396 282.2 392.91 283.83 393.5 280.39 391 277.95 394.45 277.45 396 274.32" fill="#fff"/><polygon points="408.51 274.55 410.06 277.68 413.51 278.19 411.01 280.62 411.61 284.06 408.51 282.44 405.43 284.06 406.01 280.62 403.51 278.19 406.97 277.68 408.51 274.55" fill="#fff"/><polygon points="421.15 274.2 422.69 277.33 426.15 277.83 423.65 280.27 424.24 283.71 421.15 282.09 418.06 283.71 418.65 280.27 416.15 277.83 419.6 277.33 421.15 274.2" fill="#fff"/><polygon points="433.67 274.44 435.21 277.57 438.67 278.07 436.17 280.5 436.76 283.95 433.67 282.32 430.58 283.95 431.17 280.5 428.67 278.07 432.12 277.57 433.67 274.44" fill="#fff"/><rect x="169.44" y="203.53" width="58.49" height="7.02" opacity="0.2"/><rect x="236.51" y="228.49" width="84.7" height="6.55" opacity="0.2"/><rect x="236.51" y="240.34" width="84.7" height="6.55" opacity="0.2"/><rect x="236.51" y="251.26" width="46.64" height="7.18" opacity="0.2"/><circle cx="270.28" cy="279.34" r="1.64" fill="none" stroke="#ff0303" stroke-miterlimit="10"/><circle cx="289.23" cy="279.57" r="1.64" fill="none" stroke="#ff0303" stroke-miterlimit="10"/><circle cx="279.88" cy="279.34" r="1.64" fill="none" stroke="#ff0303" stroke-miterlimit="10"/><path d="M181.71,304.6H267.3a7.43,7.43,0,0,1,7.43,7.43v34a0,0,0,0,1,0,0H174.28a0,0,0,0,1,0,0V312A7.43,7.43,0,0,1,181.71,304.6Z" fill="#ccc"/><rect x="183.32" y="312.4" width="82.36" height="5.62" opacity="0.2"/><rect x="183.32" y="323.32" width="82.36" height="5.62" opacity="0.2"/><rect x="183.32" y="334.24" width="45.23" height="5.62" opacity="0.2"/><polygon points="174.03 306.29 175.07 303.58 170.78 306.29 170.78 307.3 170.78 312.87 177.79 312.87 177.79 306.29 174.03 306.29" fill="#0071f2"/><polygon points="286.31 306.44 287.35 303.72 283.06 306.44 283.06 307.44 283.06 313.02 290.07 313.02 290.07 306.44 286.31 306.44" fill="#0071f2"/><path id="eb57ea99-c118-4c22-909b-f93f5af862ce" data-name="SVGID" d="M122.49,357h312.9a0,0,0,0,1,0,0v5.84a7.57,7.57,0,0,1-7.57,7.57H131.56a9.07,9.07,0,0,1-9.07-9.07V357A0,0,0,0,1,122.49,357Z" fill="#2f2e41"/><g clip-path="url(#f73d28a1-ee4f-4984-ae5d-2ffedea9ba65)"><path d="M122.49,365.44H435.34a0,0,0,0,1,0,0v0a5,5,0,0,1-5,5H127.48a5,5,0,0,1-5-5v0a0,0,0,0,1,0,0Z" fill="#2f2e41" opacity="0.2"/></g><g opacity="0.2"><path id="a8480395-7924-44aa-80ae-d1b34e187d02" data-name="SVGID" d="M122.49,357h312.9a0,0,0,0,1,0,0v5.84a7.57,7.57,0,0,1-7.57,7.57H131.56a9.07,9.07,0,0,1-9.07-9.07V357A0,0,0,0,1,122.49,357Z" fill="#231f20"/><g clip-path="url(#f623eb5e-f18c-429b-af18-05fa04b96e87)"><path d="M122.49,365.44H435.34a0,0,0,0,1,0,0v0a5,5,0,0,1-5,5H127.48a5,5,0,0,1-5-5v0a0,0,0,0,1,0,0Z" fill="#231f20" opacity="0.2"/></g></g><path d="M255.66,356.74h46.58a0,0,0,0,1,0,0v0A5.24,5.24,0,0,1,297,362H260.89a5.24,5.24,0,0,1-5.24-5.24v0A0,0,0,0,1,255.66,356.74Z" fill="#ccc"/><rect x="104.22" y="243.98" width="140.7" height="52.81" rx="5.08" fill="#2f2e41"/><rect x="104.22" y="243.98" width="140.7" height="52.81" rx="5.08" opacity="0.2"/><circle cx="133.33" cy="269.82" r="18.56" fill="#fff"/><ellipse cx="133.14" cy="266.74" rx="7.14" ry="9.09" fill="#f9b499"/><path d="M125.22,265.14l.39-6s.47-3.67,3.43-3.67l7.57-.16s5.85-.7,4.52,9.83l-1.32.23a15.52,15.52,0,0,0-1.17-3.93,4.22,4.22,0,0,0-3.83-2.38h-4.22a2.9,2.9,0,0,0-2.29,1.09c-1,1.32-2.45,3.63-1.67,5.77Z" fill="#2f2e41"/><ellipse cx="125.69" cy="267.32" rx="1.56" ry="2.34" transform="translate(-21.19 11.03) rotate(-4.64)" fill="#f9b499"/><ellipse cx="140.66" cy="267.25" rx="2.34" ry="1.56" transform="translate(-140.72 376.92) rotate(-83.53)" fill="#f9b499"/><path d="M118.75,281.28a33.32,33.32,0,0,1,29.51-.32s-4.53,7.27-14.93,7.42A18,18,0,0,1,118.75,281.28Z" fill="#2f2e41"/><rect x="161.25" y="256.17" width="28.08" height="2.11" fill="#fff"/><rect x="161.14" y="278.52" width="69.61" height="1.99" fill="#fff"/><rect x="161.14" y="283.66" width="42.82" height="2.22" fill="#fff"/><polygon points="164.84 263.56 166.38 266.69 169.84 267.19 167.34 269.63 167.93 273.07 164.84 271.44 161.75 273.07 162.34 269.63 159.84 267.19 163.29 266.69 164.84 263.56" fill="#fff"/><polygon points="177.47 263.56 179.01 266.69 182.47 267.19 179.97 269.63 180.56 273.07 177.47 271.44 174.38 273.07 174.97 269.63 172.47 267.19 175.93 266.69 177.47 263.56" fill="#fff"/><polygon points="189.99 263.79 191.53 266.92 194.99 267.42 192.49 269.86 193.08 273.3 189.99 271.68 186.9 273.3 187.49 269.86 184.99 267.42 188.44 266.92 189.99 263.79" fill="#fff"/><polygon points="202.62 263.44 204.17 266.57 207.62 267.07 205.12 269.51 205.71 272.95 202.62 271.32 199.53 272.95 200.12 269.51 197.62 267.07 201.08 266.57 202.62 263.44" fill="#fff"/><polygon points="215.14 263.67 216.68 266.8 220.14 267.31 217.64 269.74 218.23 273.18 215.14 271.56 212.05 273.18 212.64 269.74 210.14 267.31 213.59 266.8 215.14 263.67" fill="#fff"/><polygon points="225.75 311.29 218.89 295.17 203.86 295.52 225.75 311.29" fill="#2f2e41"/><polygon points="225.75 311.29 218.89 295.17 203.86 295.52 225.75 311.29" opacity="0.2"/><path d="M128.81,273.56l.23,3.09a3.93,3.93,0,0,0,4,3.93h0a3.93,3.93,0,0,0,3.85-4l-.29-3.15Z" fill="#f9b499"/><ellipse cx="351.66" cy="277.5" rx="7.14" ry="9.09" fill="#f9b499"/><path d="M347.62,284.33l.23,3.09a3.92,3.92,0,0,0,4,3.92h0a3.92,3.92,0,0,0,3.85-4l-.29-3.15Z" fill="#f9b499"/><path d="M343.75,275.9l.39-6s.47-3.67,3.43-3.67l7.57-.15s5.84-.71,4.52,9.82l-1.33.24s-.53-6.29-3.85-6.33l-5,0s-4.62-.11-4.31,6.83Z" fill="#2f2e41"/><ellipse cx="344.22" cy="278.09" rx="1.56" ry="2.34" transform="translate(-21.35 28.73) rotate(-4.64)" fill="#f9b499"/><ellipse cx="359.19" cy="278.01" rx="2.34" ry="1.56" transform="translate(42.5 603.61) rotate(-83.53)" fill="#f9b499"/><ellipse cx="290.83" cy="188.13" rx="7.14" ry="9.09" fill="#f9b499"/><path d="M286.5,195l.24,3.09a3.93,3.93,0,0,0,4,3.93h0a3.94,3.94,0,0,0,3.86-4l-.3-3.15Z" fill="#f9b499"/><path d="M282.92,186.53l.39-6s.46-3.66,3.43-3.66l7.56-.16s5.85-.7,4.53,9.83l-1.33.23s-.77-6.78-4.2-6.46l-5.09.06s-3.8.3-3.89,6.95Z" fill="#2f2e41"/><ellipse cx="283.38" cy="188.71" rx="1.56" ry="2.34" transform="translate(-14.32 23.52) rotate(-4.64)" fill="#f9b499"/><ellipse cx="298.36" cy="188.63" rx="2.34" ry="1.56" transform="translate(77.33 463.85) rotate(-83.53)" fill="#f9b499"/><polygon points="617.78 330.55 617.78 577 605.92 577 605.92 330.55 598.4 330.55 598.4 584.69 600.07 584.69 605.92 584.69 617.78 584.69 625.3 584.69 625.3 577 625.3 330.55 617.78 330.55" fill="#2f2e41"/><polygon points="840.69 330.55 840.69 577 829.91 577 829.91 330.55 822.37 330.55 822.37 584.69 822.42 584.69 829.91 584.69 840.69 584.69 847.65 584.69 848.22 584.69 848.22 330.55 840.69 330.55" fill="#2f2e41"/><rect x="605.93" y="251.93" width="234.76" height="170.15" rx="9.15" fill="#ccc"/><path d="M840.14,458.46H605.38a4.83,4.83,0,0,1-4.83-4.83V419.15a4.83,4.83,0,0,1,4.83-4.83l110.41,4.9q12.62.55,25.19,0l99.18-4.85a4.85,4.85,0,0,1,4.85,4.84v34.47A4.85,4.85,0,0,1,840.14,458.46Z" fill="#ccc"/><path d="M840.14,458.46H605.38a4.83,4.83,0,0,1-4.83-4.83V419.15a4.83,4.83,0,0,1,4.83-4.83l110.41,4.9q12.62.55,25.19,0l99.18-4.85a4.85,4.85,0,0,1,4.85,4.84v34.47A4.85,4.85,0,0,1,840.14,458.46Z" opacity="0.2"/><path d="M677.85,345l3,70.5s52.25,7.9,85.69,1.23,18.23-58.34,17.61-63.81a17.22,17.22,0,0,0-2.42-7.92Z" fill="#2f2e41"/><path d="M733.74,420.3a408.45,408.45,0,0,1-53-3.88.91.91,0,0,1-.77-.88l-3-70.48a.87.87,0,0,1,.25-.68.92.92,0,0,1,.66-.29H781.76a.94.94,0,0,1,.73.37,17.88,17.88,0,0,1,2.61,8.35,24.87,24.87,0,0,0,.64,3.32c2,9.73,7.49,35.64-2.5,50.77a24.74,24.74,0,0,1-16.5,10.72A173.82,173.82,0,0,1,733.74,420.3Zm-52-5.58c6.49.91,53.89,7.29,84.63,1.11a23,23,0,0,0,15.33-9.93C791.28,391.31,786,366,784,356.49c-.34-1.64-.58-2.83-.65-3.48a18.52,18.52,0,0,0-2-7.09H678.8Z" fill="#3f3d56"/><polygon points="696.72 349.82 756.72 349.82 754.35 206.65 750.1 203.35 712.78 207.6 711.83 210.44 696.72 349.82" fill="#fff"/><path d="M713.73,205.7l-2.37,13.71-7.1,129.93H659.85l-14.16-34S657,235,662.22,227.91,713.73,205.7,713.73,205.7Z" fill="#0071f2"/><path d="M711.36,219.41l2.37-13.71s-7.62,2.5-17,5.93c-1.51,10.46-3.94,33.05-.46,53.61,2.9,17.12,7.3,34.64,10.14,45.58Z" fill="#0071f2"/><path d="M712.89,220l2.58-15s-8.31,2.74-18.57,6.51c-1.65,11.48-4.29,36.28-.5,58.85,3.17,18.79,8,38,11.06,50Z" fill="#fff" opacity="0.2"/><path d="M671.19,263.31h-.09a.91.91,0,0,1-.82-1h0l1-9.45a.93.93,0,0,1,1-.82.92.92,0,0,1,.82,1h0l-.95,9.44A.93.93,0,0,1,671.19,263.31Z" opacity="0.22"/><path d="M665.05,324.26H665a.91.91,0,0,1-.8-1l5.14-51a.92.92,0,0,1,1-.8.88.88,0,0,1,.8,1h0L666,323.44A.9.9,0,0,1,665.05,324.26Z" opacity="0.22"/><path d="M689.62,126.34s1,31.65,2.37,37.32,9.78,29.72,13.08,32.56a20.13,20.13,0,0,0,7.71,3.81l-1.42,19.38s7.56,12.76,16.06,12.76,21.26-15.6,22.68-19.85S748.27,167,748.27,167s8-4.72,8.52-13.69-5.67-11.34-5.67-11.34,6.62-21.73,2.82-27.88S723.72,93.27,701.07,98s-20.78,21.26-19.38,22.68C684.24,122.69,686.89,124.59,689.62,126.34Z" fill="#f9b499"/><path d="M701,97.92c-22.68,4.72-20.78,21.26-19.38,22.68a57,57,0,0,0,5.75,4.15l1.35-.38a6,6,0,0,0,2.84.95c1.4,0,4.25-2.85,4.25-2.85s9.44,5.2,11.81,4.73,6.15-6.13,10.39-6.13,16.54-.47,14.17,5.2-7.07,8-1.82,11.34,9.91,3.3,10.39,7.07-3.32,12.76.47,13.24,6.62-6.62,7.08-9.92a14.1,14.1,0,0,1,2.84-6.15s6.62-21.73,2.83-27.87S723.64,93.27,701,97.92Z" fill="#2f2e41"/><path d="M712.78,200a46.59,46.59,0,0,0,18-7.07,103.33,103.33,0,0,0,9.44-7.09l-28.35,24.57Z" fill="#f4a58c"/><path d="M750.1,203.35l-2.35,144.57,43.46.95,6.14-23.15,32.6-1.83s-11.34-58.57-15.59-75.11-4.26-20.33-10.94-26S750.1,203.35,750.1,203.35Z" fill="#0071f2"/><path d="M748.6,300.94a165.66,165.66,0,0,0,12-22.95c6.07-14.15,5.21-57.76,4.85-70-8.62-2.72-15.24-4.65-15.24-4.65Z" fill="#0071f2"/><path d="M748.6,300.94a165.66,165.66,0,0,0,12-22.95c6.07-14.15,5.21-57.76,4.85-70-8.62-2.72-15.24-4.65-15.24-4.65Z" fill="#fff" opacity="0.2"/><path d="M786.51,248.8a.9.9,0,0,1-.92-.86l-.49-8.64a.9.9,0,0,1,.84-1h0a.86.86,0,0,1,1,.74v.12l.48,8.62a.9.9,0,0,1-.82,1h-.07Z" opacity="0.22"/><path d="M790.73,323.78a.9.9,0,0,1-.91-.85l-3.64-65.05a.91.91,0,0,1,.85-.95.86.86,0,0,1,1,.74.49.49,0,0,1,0,.12l3.65,65a.91.91,0,0,1-.86.94Z" opacity="0.22"/><path d="M787.2,321.09s6.36-5.57,11.14-6.5,19.89.52,26.32,1.83,10.65,10.32,13.11,16.64-.36,17.41-5.47,20.24-14.8,3.46-14.8,3.46Z" fill="#0071f2"/><path d="M787.2,321.09s6.36-5.57,11.14-6.5,19.89.52,26.32,1.83,10.65,10.32,13.11,16.64-.36,17.41-5.47,20.24-14.8,3.46-14.8,3.46Z" opacity="0.22"/><path d="M829,329.13c-5.47-6.77-57.73-10.76-57.73-10.76-10.25-.89-20.06-1.71-21.33-1.71-3,0-29.48,20.47-33,22a1.35,1.35,0,0,0-1,1.42l-7.47,10.56,18.78-1.53c5.72,1.44,14-2.15,16.18-3.47,2.5-1.49,10.94-10,10.94-10L792.87,352a25.19,25.19,0,0,0,2.53,2.08c5,3.37,20.44,6.58,28.46,3.17S835.47,337.15,829,329.13Z" fill="#f9b499"/><path d="M739.23,410s-3-4.25-7.29-15.81,11.54-75.35,11.54-75.35l47.4-17A194.78,194.78,0,0,1,798.17,345c1.22,23.71,1.83,54.7-5.47,63.21s-39.5,10.94-48.62,9.12" fill="#2f2e41"/><path d="M739.23,410s-3-4.25-7.29-15.81,11.54-75.35,11.54-75.35l47.4-17A194.78,194.78,0,0,1,798.17,345c1.22,23.71,1.83,54.7-5.47,63.21s-39.5,10.94-48.62,9.12" fill="#2f2e41"/><polygon points="607.35 210.71 624.38 258.72 646.25 255.07 631.05 205.85 607.35 210.71" fill="#2f2e41"/><path d="M617.34,241.71s-12.11-14.13-8.57-15.65,10.08-4.54,13.13-2.53a6,6,0,0,1,2.51,5.56l-7.56.49,5,10.61Z" fill="#f9b499"/><path d="M633.45,230.18s-23.7,7.81-23,10,16.31,35.63,16.31,35.63l4.09,64.55,29.31-14.47L635.3,273.23s1.13-5.94-.73-8.92a72.33,72.33,0,0,1-3.65-7.05s10.39-2.23,10.39-4.09S633.45,230.18,633.45,230.18Z" fill="#f9b499"/><path d="M615.64,246.68a.89.89,0,0,1-.85-.56.92.92,0,0,1,.5-1.19h0L635,236.77a.92.92,0,0,1,1.2.49.94.94,0,0,1-.49,1.2L616,246.61A.71.71,0,0,1,615.64,246.68Z" fill="#f4a58c"/><path d="M619.73,254.1a.91.91,0,0,1-.35-1.75l17.81-7a.91.91,0,1,1,.68,1.69h0l-17.82,7.06A.86.86,0,0,1,619.73,254.1Z" fill="#f4a58c"/><path d="M794,320.05s-7.07-42.52-17-44.42-151.66,57.65-161.1,60.95-18.44,5.64-18.44,5.64-19.36-3.3-29.75-9S551.2,320,547.4,329s5.67,28.82,11.34,32.61,21.28,14.59,25.53,16.54,25.52-9.94,33.07-13.71,77.48-23.7,102.09-27.87,47.24-9.45,57.63-17" fill="#2f2e41"/><path d="M621.15,362.94l-8.83-25.14c-8,2.65-14.84,4.45-14.84,4.45s-19.36-3.3-29.75-9S551.2,320.05,547.4,329s5.67,28.82,11.34,32.61,21.28,14.59,25.53,16.54,25.52-9.94,33.07-13.71A40.12,40.12,0,0,1,621.15,362.94Z" fill="#f9b499"/><path d="M547.4,329c-3.77,9,5.67,28.82,11.34,32.61s21.28,14.59,25.53,16.54c3.26,1.44,16.57-5.2,26-10.07l-6.63-8.84a91.52,91.52,0,0,0,2.84-10.94c.95-5.19-9-6.14-9-6.14s-19.36-3.3-29.75-9S551.2,320.05,547.4,329Z" fill="#3f3d56"/><path d="M547.4,329c-3.77,9,5.67,28.82,11.34,32.61s21.28,14.59,25.53,16.54c3.26,1.44,16.57-5.2,26-10.07l-6.63-8.84a91.52,91.52,0,0,0,2.84-10.94c.95-5.19-9-6.14-9-6.14s-19.36-3.3-29.75-9S551.2,320.05,547.4,329Z" fill="#0071f2"/><path d="M585.16,378.33h.35a4.22,4.22,0,0,0,.87,0h.42a6,6,0,0,0,1.26-.25h.24l1.82-.53.25-.09c-3.46-2.36-21.69-15-31.08-26.07-7.55-8.92-8.11-20.55-7.86-26.26-1.55.26-2.84,1.44-3.95,4.05-3.78,9,5.67,28.82,11.34,32.62s21.27,14.58,25.52,16.53A2.82,2.82,0,0,0,585.16,378.33Z" fill="#fff"/><path d="M674.35,584.69a44.23,44.23,0,0,0,1.07-10.57c0-6.08-3.64-37.07-3-42.54s23.7-147.67,23.7-147.67L721,387.56s-9.12-33.44-19.45-45-38.29-11.54-49.23-6.69-12.16,34-10.94,60.78,4.25,142.81,4.25,142.81-11.54,27.94-15.18,35.24c-2.72,5.47-5.11,8.18-4.62,10Z" fill="#2f2e41"/><path d="M625.6,584.69h48.75a44.23,44.23,0,0,0,1.07-10.57c0-6.08-3.64-37.07-3-42.54,0-.53.31-2.44.75-5.47H645.32c.2,8.32.31,13.37.31,13.37s-11.54,27.94-15.18,35.24C628,579.55,625.72,582.87,625.6,584.69Z" fill="#f9b499"/><path d="M674.35,584.69a44.23,44.23,0,0,0,1.07-10.57c0-3.23-1-13.53-1.91-23.29l-4.18-.41s-1.2-10.34-9.71-12.77a16.39,16.39,0,0,0-14,1.83s-11.54,27.94-15.18,35.24c-2.41,4.83-4.73,8.16-4.85,10Z" fill="#3f3d56"/><path d="M674.35,584.69a44.23,44.23,0,0,0,1.07-10.57c0-3.23-1-13.53-1.91-23.29l-4.18-.41s-1.2-10.34-9.71-12.77a16.39,16.39,0,0,0-14,1.83s-11.54,27.94-15.18,35.24c-2.41,4.83-4.73,8.16-4.85,10Z" fill="#0071f2"/><path d="M674.35,584.69a29.34,29.34,0,0,0,.84-5.1H627.78a16.12,16.12,0,0,0-2.22,5.1Z" fill="#fff"/></svg>
                </div>
                <div class="text-center">
                    <h1 class="text-lg">
                        {{_e('No comments found')}}
                    </h1>
                    <p>
                        {{_e('Your queue is clear.')}}
                    </p>
                </div>
            </div>
        @endif

    </div>

    <div class="row p-0">

        <div class="col-3">
            <div class="mb-2">
                <span>{{$comments->count()}} {{_e('items on page. Total')}}: {{$comments->total()}} </span>
            </div>
        </div>

        <div class="col-sm-7 text-center">
            <div class="pagination justify-content-center">
                <div class="pagination-holder">
                    {{$comments->links()}}
                </div>
            </div>
        </div>

        <div class="col-sm-2 text-center text-sm-right">
            <div class="form-group">
                <form method="get">
                    <small>{{_e('Show items per page')}}</small>
                    <select class="form-select" wire:model="itemsPerPage">
                        <option value="">Select</option>
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

</div>
