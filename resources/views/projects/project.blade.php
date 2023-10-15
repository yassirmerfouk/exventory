<x-layout>
    <div class="card card-solid">
        <div class="card-body">
            <div class="container">
                <div class="main-body">

                    <div class="row gutters-sm">
                        <?php $project_image = $project->getMedia('images'); ?>
                        @if (!empty($project_image->toArray()))
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="{{ $project_image[0]->getUrl() }}" width="150">
                                            <div class="mt-3">
                                                <h4>{{ $project->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (empty($project_image->toArray()))
                            <div class="col-md-12">
                            @else
                                <div class="col-md-8">
                        @endif
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Project Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $project->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Project Field</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $project->field->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Client Company</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if ($project->client_company == null)
                                            Internal project
                                        @else
                                            {{ $project->client_company }}
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Project Start Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $project->start_date }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Project Start Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if ($project->end_date == null)
                                            Not defined
                                        @else
                                            {{ $project->end_date }}
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <span class="btn btn-primary btn-xs"
                                            style="border-radius: 5">{{ $project->status }}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Project Progress</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div class="progress">
                                            <div class="progress-bar bg-primary"
                                                style="width:{{ $project->progress }}%">
                                                {{ $project->progress }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Project Budget</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if ($project->budget == null)
                                            Not defined
                                        @else
                                            {{ $project->budget }} Dhs
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Team Work</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if (empty($project->users->toArray()))
                                            No one
                                        @else
                                            @foreach ($project->users as $user)
                                                {{ $user->first_name }}&nbsp{{ $user->last_name }},
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Project Description</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if ($project->description == null)
                                            No description
                                        @else
                                            {{ $project->description }}
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Project Files</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php $project_files = $project->getMedia('files'); ?>
                                        @if (empty($project_files->toArray()))
                                            No Files for the project
                                        @else
                                            @foreach ($project_files as $file)
                                                <a target="_blank" href="{{ $file->getUrl() }}"><span
                                                        class="btn btn-primary btn-xs" style="border-radius: 5">Show
                                                        file</span></a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn btn-primary float-right ml-1" target="__blank"
                                            href="{{ route('projectUpdatePage', $project->id) }}"><i
                                                class="far fa-edit"></i>&nbsp;Edit
                                            project</a>
                                        <a href="{{ route('projects') }}"><button type="button"
                                                class="btn btn-primary float-right"><i
                                                    class="fa fa-undo"></i>&nbsp;Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</x-layout>
