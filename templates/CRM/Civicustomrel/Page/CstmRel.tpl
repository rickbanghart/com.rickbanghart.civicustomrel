{assign var=counter value=1}
<table border="1" style="width:60%;border-width: 1px;border-style: solid;border-color: black">
    <tr><th style="width:20px;"></th><th style="width:120px;">Owner Name</th><th style="width:60px;">Pet Name</th><th>Breed</th></tr>
    <a title="Click to Save" class="button_name button" href="#">
        <span>Click to Save</span>
    </a>
    <br/>
{foreach from=$contacts item=contact}
    <tr style="background-color: antiquewhite">
        <td style="width: 20px;">{$counter++}</td>
        <td style="width:100px;white-space: nowrap">{$contact.first_name} {$contact.last_name}</td>
        <td style="width:60px;white-space: nowrap">{$contact.pet_name}</td>
        <td style="width: 60px;white-space: nowrap">{$contact.breed}</td>
    </tr>
{/foreach}
</table>
