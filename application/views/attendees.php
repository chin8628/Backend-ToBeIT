<body>
    <div class="container">
        <div class="page-header">
            <h1>Attendees List <small>({number_atten} คน)</small></h1>
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