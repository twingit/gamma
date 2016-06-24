<p>Welcome, <?= $current_user['name'] ?>! (<a href="/users/logout">Logout</a>)</p>

<p><?= $current_user['name'] ?> has poked <?= $poked_count['people_count_poked'] ?> people.</p>

<p><?= $current_user['name'] ?> has been poked by <?= $poked_by_count['people_count_poked_by'] ?> people.</p>

<p><?= $current_user['name'] ?> has poked:</p>

<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Number of Times Poked</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($pokers as $poke) { ?>
				<tr>
					<td><?= $poke['poked_name'] ?></td>
					<td><?= $poke['count'] ?></td>
				</tr>
		<?php } ?>
	</tbody>
</table>

<p><?= $current_user['name'] ?> has been poked by:</p>

<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Number of Times Poked</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($pokeds as $poke) { ?>
				<tr>
					<td><?= $poke['poker_name'] ?></td>
					<td><?= $poke['count'] ?></td>
				</tr>
		<?php } ?>
	</tbody>
</table>

<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Alias</th>
			<th>Email</th>
			<th>Number of Times Poked</th>
			<th>Poke</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($pokes as $poke) { ?>
			<tr>
				<td><?= $poke['poked'] ?></td>
				<td><?= $poke['alias'] ?></td>
				<td><?= $poke['email'] ?></td>
				<td><?= $poke['count'] ?></td>
				<td>
					<form action="/pokes/create/<?= $poke['id'] ?>" method="post">
						<input type="submit" value="Poke">
						<!-- <input type="hidden" name="poked_id" value=""> -->
					</form>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
