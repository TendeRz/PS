		<div class="col-xs-4">
			<table class="table table-striped">
				<tr>
					<th> # </th>						
					<th>Flag</th>
					<th>Country</th>
				</tr>
				<?php
					$list = selectAll("countries");
					foreach ($list as $key => $value) {
						echo '<tr>';
							echo '<td style="width: 60px">
									<input type="checkbox" name="like" value="Yes" />
								</td>';
							echo '<td style="width: 60px">
									<img class="flag" src="./adds/queries.php?cFlag='.$value[1].'">
								</td>';
							echo '<td>'.$value[1].'</td>';
						echo '</tr>';
					}
				?>
			</table>
		</div>