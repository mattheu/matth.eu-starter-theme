<?php get_header(); ?>

<style>
	body { font-size: 14px; line-height: 20px; }
	.site-header { display: none;  }
	.wrap { background: rgba(0,0,0,0.05); max-width: 660px; padding: 19px; margin-top: 20px; margin-bottom: 20px; border: 1px solid #CCC; border-radius: 3px; }

	.field input[type="text"],
	.field input[type="password"],
	.field input[type="email"],
	.field textarea { width: 100%; padding: 4px; line-height: 20px; font-size: 1em; margin: 0 -5px; border: 1px solid #CCC; border-radius: 3px; display: inline-block; vertical-align: top; max-width: 100%; }
	.field select { max-width: 100%; margin: 5px -5px 0; display: inline-block;}
	.field input[type="radio"],
	.field input[type="checkbox"] { margin: 0; }

	.field { clear: both; margin: 0; padding: 5px 10px; padding-left: 200px; /*background: rgba(255,0,0,0.1); border-bottom: 1px solid rgba(255,0,0,0.1);*/ }
	.field:before,
	.field::after 							{ content:""; display:table; }
	.field::after							{ clear:both; }
	.field 									{ zoom:1; }

	.group { padding: 9px; border: 1px solid #CCC; border-radius: 3px; margin: 10px -10px; }

	.field-title { width: 170px; float: left; margin: 0 0 0 -200px; padding: 5px 0 0; }
	.field-items { width: 100%; padding: 0 5px; }
	.field-item { margin: 5px 0; }
	.field.actions { padding: 10px 0 10px 200px; }

	.field.repeatable .field-item { position: relative; padding-right: 40px; }
	.field.repeatable .field-item .delete { background: rgba(0,0,0,0.2); border-radius: 99px; height: 20px; width: 20px; display: block; position: absolute; top: 5px; right: 5px; text-align: center; color:#FFFFFF; font-weight: bold; cursor: pointer; line-height: 19px; }
	.field.repeatable .field-item .delete:hover { background: rgba(0,0,0,0.5); }
	.field.repeatable .actions { margin: 5px -5px; }

	.field.draggable .field-item { position: relative; padding-left: 20px; }
	.field.draggable .field-item .drag-handle { position: absolute; top: 4px; left: 0px; height: 14px; margin: 2px 0; width: 5px; border-left: 1px solid #CCC; border-right: 1px solid #CCC; cursor: move; }
	.field.draggable .field-item .drag-handle::after { content: ' '; display: inline-block; position: relative; top: -1px; margin-right: 2px; margin-left: 2px; border-left: 1px solid #CCC; height: 100%; }

 	.field-item label + input,
 	.field-item input + label { margin-left: 5px; }

 	.field-items.inline .field-item { margin-right: 20px; float: left; margin: 5px 20px 5px 0; }
 	.field-items.inline .field-item label + input,
 	.field-items.inline .field-item input + label { margin-left: 5px; }

 	.field-img .field-items { padding: 0; margin: 0 -20px 0 -10px; width: auto; }
 	.field-img .field-item { height: 98px; width: 98px; border: 1px solid #CCC; border-radius: 3px; float: left; margin: 10px; }

 	.field-img.draggable .field-item { padding-left: 0; }

@media all and (max-width: 740px) {

 	.wrap { border-width: 1px 0; }

	.field { padding-left: 0; }
	.field-title { width: auto; float: none; margin: 0 0 10px; padding: 0; }
	.field.repeatable .delete { top: 5px; }
	.repeatable-add-new { margin-left: 0; }
	.field.draggable .drag-handle { top: 50%; height: 24px; margin-top: -12px; }
	.field.draggable .drag-handle::after { top: 0; }

}

</style>

<div class="field field-img draggable">
	<div class="field-title">
		<label>Image</label>
	</div>
	<div class="field-items">
		<div class="field-item"><div class="mult-item-controls"></div></div>
		<div class="field-item"></div>
		<div class="field-item"></div>
		<div class="field-item"></div>
		<div class="field-item"></div>
	</div>
</div>

<div class="field">
	<div class="field-title">
		<label>URL Text Field</label>
	</div>
	<div class="field-items">
		<div class="field-item"><input class="cmb_text_urlcode" type="text" name="input3[]" value=""></div>
	</div>
</div>

<div class="field">
	<div class="field-title">
		<label>URL Text Field</label>
	</div>
	<div class="field-items">
		<div class="field-item"><input class="cmb_text_urlcode" type="text" name="input3[]" value=""></div>
		<div class="field-item"><input class="cmb_text_urlcode" type="text" name="input3[]" value=""></div>
	</div>
</div>

<div class="field">
	<div class="field-title">
		<label>URL Text Field</label>
	</div>
	<div class="field-items">
		<div class="field-item"><textarea></textarea></div>
	</div>
</div>

<div class="field">
	<div class="field-title">
		<label>URL Text Field</label>
	</div>
	<div class="field-items">
		<div class="field-item">
			<select>
				<option>One</option>
				<option>Two</option>
				<option>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in blandit. Curabitur vulputate, ligula lacinia scelerisque tempor, lacus lacus ornare ante, ac egestas est urna sit amet arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed molestie augue sit amet leo consequat posuere. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vel ante a orci tempus eleifend ut et magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum.</option>
			</select>
		</div>
	</div>
</div>

<div class="field">
	<div class="field-title">
		<label>Checkboxes</label>
	</div>
	<div class="field-items">
		<div class="field-item">
			<input type="checkbox" name="checkbox" id="multicheckbox1"/>
			<label for="multicheckbox1">Option 1</label>
		</div>
		<div class="field-item">
			<input type="checkbox" name="checkbox" id="multicheckbox2"/>
			<label for="multicheckbox2">Option 2</label>
		</div>
		<div class="field-item">
			<input type="checkbox" name="checkbox" id="multicheckbox3"/>
			<label class="checkbox" for="multicheckbox3">Option 3</label>
		</div>
		<div class="field-item">
			<input type="checkbox" name="checkbox" id="multicheckbox4"/>
			<label class="checkbox" for="multicheckbox4">Option 4</label>
		</div>
		<div class="field-item">
			<input type="checkbox" name="checkbox" id="multicheckbox5"/>
			<label class="checkbox" for="multicheckbox5">Option 5</label>
		</div>
		<div class="field-item">
			<input type="checkbox" name="checkbox" id="multicheckbox6"/>
			<label class="checkbox" for="multicheckbox6">Option 6</label>
		</div>
	</div>
</div>

<div class="field">
	<div class="field-title">
		<label>Radio Buttons</label>
	</div>
	<div class="field-items inline">
		<div class="field-item">
			<input type="radio" name="radio" id="radio1"/>
			<label class="radio" for="radio1">Yes</label>
		</div>
		<div class="field-item">
			<input type="radio" name="radio" id="radio2"/>
			<label class="radio" for="radio2">No</label>
		</div>
		<div class="field-item">
			<input type="radio" name="radio" id="radio3"/>
			<label class="radio" for="radio3">Maybe</label>
		</div>
	</div>
</div>

<div class="field">
	<div class="field-title">
		<label>Checkboxes</label>
	</div>
	<div class="field-items inline">
		<div class="field-item">
			<label for="checkbox1">Option 1</label>
			<input type="checkbox" name="checkbox" id="checkbox1"/>
		</div>
		<div class="field-item">
			<label for="checkbox2">Option 2</label>
			<input type="checkbox" name="checkbox" id="checkbox2"/>
		</div>
		<div class="field-item">
			<label class="checkbox" for="checkbox3">Option 3</label>
			<input type="checkbox" name="checkbox" id="checkbox3"/>
		</div>
		<div class="field-item">
			<label class="checkbox" for="checkbox4">Option 4</label>
			<input type="checkbox" name="checkbox" id="checkbox4"/>
		</div>
		<div class="field-item">
			<label class="checkbox" for="checkbox4">Option 4</label>
			<input type="checkbox" name="checkbox" id="checkbox4"/>
		</div>
		<div class="field-item">
			<label class="checkbox" for="checkbox5">Option 5</label>
			<input type="checkbox" name="checkbox" id="checkbox5"/>
		</div>
	</div>
</div>

<div class="group">

	<div class="group-title">
		<h3>This is a group</h3>
	</div>

	<div class="field repeatable">
		<div class="field-title">
			<label>URL Text Field</label>
		</div>
		<div class="field-items">
			<div class="field-item"><input class="cmb_text_urlcode" type="text" name="input3[]" value=""><div class="delete">&times;</div></div>
			<div class="field-item"><input class="cmb_text_urlcode" type="text" name="input3[]" value=""><div class="delete">&times;</div></div>
			<div class="actions">
				<button class="repeatable-add-new">Add Row</button>
			</div>
		</div>
	</div>

</div>

<div class="field repeatable draggable active">
	<div class="field-title">
		<label>URL Text Field</label>
	</div>
	<div class="field-items">
		<div class="field-item">
			<input class="cmb_text_urlcode" type="text" name="input3[]" value="">
			<div class="delete">&times;</div>
			<div class="drag-handle"></div>
		</div>
		<div class="field-item">
			<input class="cmb_text_urlcode" type="text" name="input3[]" value="">
			<div class="delete">&times;</div>
			<div class="drag-handle"></div>
		</div>
		<div class="field-item">
			<input class="cmb_text_urlcode" type="text" name="input3[]" value="">
			<div class="delete">&times;</div>
			<div class="drag-handle"></div>
		</div>
		<div class="actions">
			<button class="repeatable-add-new">Add Row</button>
		</div>
	</div>
</div>