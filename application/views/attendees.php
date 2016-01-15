<body>
    <div class="container">
        {alert}
        <div class="page-header">
            <h1>Attendees Search <small>({number_atten} คน)</small></h1>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" method="get">
                    <div class="form-group">
                        <label for="search" class="col-sm-2 control-label">Search</label>
                        <div class="col-sm-8">
                            <input type="text" name="search" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="option" class="col-sm-2 control-label">Keyword</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="option" value="id"> หมายเลขประจำตัว
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="option" value="name"> ชื่อ
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="option" value="surname"> นามสกุล
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="option" value="nickname"> ชื่อเล่น
                            </label>
                            <!-- <label class="radio-inline">
                                <input type="radio" name="option" value="school"> โรงเรียน
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="option" value="religion"> ศาสนา
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="option" value="shirt"> ไซส์เสื้อ
                            </label> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Nickname</th>
                        <th>Facebook</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {table_attendees}
                </tbody>
            </table>
        </div>
        <div class="text-center">{pagination}</div>
    </div>
</body>