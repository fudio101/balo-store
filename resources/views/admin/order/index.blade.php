@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 48px;">
        <div class="col-md-12 table-responsive">
            <h3>$title</h3>

            <table class="table table-striped table-hover" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Order Code</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $index = 0;
                foreach ($data as $item) {
                    echo '<tr style="height: 90px;">
					<th>'.(++$index).'</th>
					<td><a href="detail.php?id='.$item['id'].'">'.$item['orderCode'].'</a></td>
					<td>'.$item['fullname'].'</td>
					<td>'.$item['phone'].'</td>
					<td>'.$item['address'].'</td>
					<td>'.max($item['money'] - $item['coupon'], 0).'</td>
					<td>'.$item['created'].'</td>
					<td>';
                    if ($item['status_code'] == 1) {
                        echo '<label class="badge bg-info">Paid</label>';
                    } elseif ($item['status_code'] == 2) {
                        echo '	<label class="badge bg-info">Delivering</label>';
                    } elseif ($item['status_code'] == 3) {
                        echo '	<label class="badge btn-primary">Delivered</label>';
                    } else {
                        echo '<label class="badge btn-danger">Canceled</label>';
                    }
                    echo '</td>
					<td>';
                    if ($item['status_code'] == 1) {
                        echo '	<button onclick="changeStatus('.$item['id'].', 2)" class="btn btn-sm btn-success">Approve</button>
								<button onclick="changeStatus('.$item['id'].', 4)" class="btn btn-sm bg-warning">Cancel</button>';
                    } elseif ($item['status_code'] == 2) {
                        echo '	<button onclick="changeStatus('.$item['id'].', 3)" class="btn btn-sm btn-success">Received</button>
								<button onclick="changeStatus('.$item['id'].', 4)" class="btn btn-sm bg-warning">Cancel</button>';
                    }
                    echo '</td>
				</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function changeStatus(id, status) {
            $.post('form_api.php', {
                'id': id,
                'status': status,
                'action': 'update_status'
            }, function (data) {
                location.reload()
            })
        }
    </script>
@endsection
