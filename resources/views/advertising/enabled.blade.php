		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="flash-message">
				  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
					@if(Session::has('alert-' . $msg))
					<p class="alert alert-{{ $msg }} noMarginBottom text-center">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>{{ Session::get('alert-' . $msg) }}</strong>
					</p>
					{{ Session::forget('alert-' . $msg) }}
					@endif
				  @endforeach
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h4 class="text-center lander">Reach thousands of locals directly using <span class="text-danger">{{ str_replace(' ','&nbsp;',env('APP_NAME')) }}</span> Advertising.</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<p class="text-center">Targetting locals has never been easier. <span class="text-danger">{{ str_replace(' ','&nbsp;',env('APP_NAME')) }}</span> believes in complete transparancy. Below you will find a graph which shows our subscriber growth since our release.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center">
				<div id="pop_div"></div>
				@areachart('Subscribers', 'pop_div')
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="list-group">
					<a href="javascript:;" class="list-group-item visitor text-center">
						<h4 class="list-group-item-heading count">{{ $counts['total'] }}</h4>
						<p class="list-group-item-text">Total Subscribers</p>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="list-group list-group-horizontal">
					<a href="javascript:;" class="list-group-item thirds visitor text-center">
						<h4 class="list-group-item-heading count">{{ $counts['males'] }}</h4>
						<p class="list-group-item-text">Males</p>
					</a>
					<a href="javascript:;" class="list-group-item thirds visitor text-center">
						<h4 class="list-group-item-heading count">{{ $counts['females'] }}</h4>
						<p class="list-group-item-text">Females</p>
					</a>
					<a href="javascript:;" class="list-group-item thirds visitor text-center">
						<h4 class="list-group-item-heading count">{{ $counts['families'] }}</h4>
						<p class="list-group-item-text">Families</p>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<p class="text-center"><span class="text-danger">{{ str_replace(' ','&nbsp;',env('APP_NAME')) }}</span> sends out an email once a week. We offer single email adverisements as well as month block (4 week) advertisements. Each email contains 5 advertising blocks which consist of two types as displayed below.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default ad_rates">
					<div class="panel-heading text-center"><strong><span class="text-danger">{{ str_replace(' ','&nbsp;',env('APP_NAME')) }}</span> Email Template</strong></div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 bg-info text-center placement_block no_top">
								<br /><br /><br /><h5>Ad Block 1<br />(600x250)<br /><small>Class A</small></h5><br /><br /><br />
							</div>
						</div>
						<div class="row coupon_row">
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
						</div>
						<div class="row coupon_row">
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
						</div>
						<div class="row coupon_row">
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-3 bg-info text-center placement_block" style="border-right:1px solid #dddddd;">
								<br /><br /><h5>Ad Block 2<br />(150x150)<br /><small>Class B</small></h5><br /><br />
							</div>
							<div class="col-xs-3 bg-info text-center placement_block" style="border-right:1px solid #dddddd;">
								<br /><br /><h5>Ad Block 3<br />(150x150)<br /><small>Class B</small></h5><br /><br />
							</div>
							<div class="col-xs-3 bg-info text-center placement_block" style="border-right:1px solid #dddddd;">
								<br /><br /><h5>Ad Block 4<br />(150x150)<br /><small>Class B</small></h5><br /><br />
							</div>
							<div class="col-xs-3 bg-info text-center placement_block">
								<br /><br /><h5>Ad Block 5<br />(150x150)<br /><small>Class B</small></h5><br /><br />
							</div>
						</div>
						<div class="row coupon_row">
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
						</div>
						<div class="row coupon_row">
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
						</div>
						<div class="row coupon_row">
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
							<div class="col-xs-6 bg-warning text-center coupon_block">
								<br /><h5>Coupon</h5><br />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default ad_rates">
					<div class="panel-heading text-center"><strong>Advertising Rates (All Subscribers)</strong></div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center">Ad Placement</th>
								<th class="text-center">Single Email</th>
								<th class="text-center">Month Block</th>
								<th class="text-center">Availability</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">Class A</td>
								<td class="text-center">${{ number_format( $blocks['top'], 2 ) }}</td>
								<td class="text-center">${{ number_format( (($blocks['top']*4)*.8), 2) }}</td>
								<td class="text-center"><a href="{{ url('/contact?list=All Subscribers&class=A') }}">Enquire</a></td>
							</tr>
							<tr>
								<td class="text-center">Class B</td>
								<td class="text-center">${{ number_format( $blocks['second'], 2 ) }}</td>
								<td class="text-center">${{ number_format( (($blocks['second']*4)*.8), 2) }}</td>
								<td class="text-center"><a href="{{ url('/contact?list=All Subscribers&class=B') }}">Enquire</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default ad_rates">
					<div class="panel-heading text-center"><strong>Advertising Rates (Males)</strong></div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center">Ad Placement</th>
								<th class="text-center">Single Email</th>
								<th class="text-center">Month Block</th>
								<th class="text-center">Availability</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">Class A</td>
								<td class="text-center">${{ number_format( $blocks['males']['top'], 2 ) }}</td>
								<td class="text-center">${{ number_format( (($blocks['males']['top']*4)*.8), 2) }}</td>
								<td class="text-center"><a href="{{ url('/contact?list=Males&class=A') }}">Enquire</a></td>
							</tr>
							<tr>
								<td class="text-center">Class B</td>
								<td class="text-center">${{ number_format( $blocks['males']['second'], 2 ) }}</td>
								<td class="text-center">${{ number_format( (($blocks['males']['second']*4)*.8), 2) }}</td>
								<td class="text-center"><a href="{{ url('/contact?list=Males&class=B') }}">Enquire</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default ad_rates">
					<div class="panel-heading text-center"><strong>Advertising Rates (Females)</strong></div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center">Ad Placement</th>
								<th class="text-center">Single Email</th>
								<th class="text-center">Month Block</th>
								<th class="text-center">Availability</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">Class A</td>
								<td class="text-center">${{ number_format( $blocks['females']['top'], 2 ) }}</td>
								<td class="text-center">${{ number_format( (($blocks['females']['top']*4)*.8), 2) }}</td>
								<td class="text-center"><a href="{{ url('/contact?list=Females&class=A') }}">Enquire</a></td>
							</tr>
							<tr>
								<td class="text-center">Class B</td>
								<td class="text-center">${{ number_format( $blocks['females']['second'], 2 ) }}</td>
								<td class="text-center">${{ number_format( (($blocks['females']['second']*4)*.8), 2) }}</td>
								<td class="text-center"><a href="{{ url('/contact?list=Females&class=B') }}">Enquire</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default ad_rates">
					<div class="panel-heading text-center"><strong>Advertising Rates (Families)</strong></div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center">Ad Placement</th>
								<th class="text-center">Single Email</th>
								<th class="text-center">Month Block</th>
								<th class="text-center">Availability</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">Class A</td>
								<td class="text-center">${{ number_format( $blocks['families']['top'], 2 ) }}</td>
								<td class="text-center">${{ number_format( (($blocks['families']['top']*4)*.8), 2) }}</td>
								<td class="text-center"><a href="{{ url('/contact?list=Families&class=A') }}">Enquire</a></td>
							</tr>
							<tr>
								<td class="text-center">Class B</td>
								<td class="text-center">${{ number_format( $blocks['families']['second'], 2 ) }}</td>
								<td class="text-center">${{ number_format( (($blocks['families']['second']*4)*.8), 2) }}</td>
								<td class="text-center"><a href="{{ url('/contact?list=Families&class=B') }}">Enquire</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>