<body>
    <div class="container">
        <section class="col-sm-7">
            <div class="panel panel-default">
                <div class="panel-heading">สถิติภาพรวม ToBeIT</div>
                <div class="panel-body">
                    <p><b>แบ่งจำนวนผู้เข้าร่วมตามเพศ</b></p>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>ชาย</td>
                                <td class="col-sm-2 text-center">{stat_male} คน</td>
                            </tr>
                            <tr>
                                <td>หญิง</td>
                                <td class="col-sm-2 text-center">{stat_female} คน</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>จำนวนผู้เข้าร่วมทั้งหมด: {total_attendee}</p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">สถิติประจำวันนี้</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>จำนวนคนทั้งหมดประจำวันนี้</td>
                                <td class="col-sm-2 text-center">{checkin_today} คน</td>
                            </tr>
                            <tr>
                                <td>จำนวนคนเช็คอินมาเรียนประจำวันนี้</td>
                                <td class="col-sm-2 text-center">{stay_today} คน</td>
                            </tr>
                            <tr>
                                <td>จำนวนคนกลับบ้านแล้วประจำวันนี้</td>
                                <td class="col-sm-2 text-center">{back_home_today} คน</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="col-sm-5">
            <div class="panel panel-default">
                <div class="panel-heading">จำนวนนักเรียนในแต่ละห้องเรียน</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            {number_std_class}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</body>