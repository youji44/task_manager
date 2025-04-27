<div class="card">
    <div class="card-body">
        <h4 class="header-title">{{isset($task)?'Edit a':'Add a new'}} Task</h4>
        @include('notifications')
        <form class="needs-validation" novalidate="" action="{{route('task.save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input title="" hidden value="{{isset($task)?$task->id:''}}" name="id">
            <div class="form-group">
                <label for="date" class="col-form-label">Date</label>
                <input id="date" class="form-control" type="date" value="{{isset($task)?$task->date:date('Y-m-d')}}" name="date">
            </div>
            <div class="form-group">
                <label for="time" class="col-form-label">Time</label>
                <input class="form-control" type="time" value="{{isset($task)?$task->time:date('H:i')}}" placeholder="00:00" id="time" name="time">
            </div>
            <div class="form-group">
                <label for="task_name" class="col-form-label">Task Name</label>
                <input required name="task_name" class="form-control" id="task_name" value="{{isset($task)?$task->task_name:''}}"/>
            </div>
            <button type="submit" class="btn btn-success"><i class="ti-save"> </i> Save </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"> Cancel </button>
        </form>
    </div>
</div>
<script>
    flatpickr("#date");
    $('.needs-validation').on('submit', function(event) {
        let form = $(this);
        if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }else{
            $(":submit", this).attr("disabled", "disabled");
        }
        form[0].classList.add('was-validated');
    });
</script>
