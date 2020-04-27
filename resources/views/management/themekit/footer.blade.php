<div class="w-100 clearfix">
    <span class="text-center text-sm-left d-md-inline-block">Copyright © 2020</span>
</div>



<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">ออกจากระบบ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                ต้องการออกจากระบบ ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <a type="button" class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                    ยืนยัน</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
