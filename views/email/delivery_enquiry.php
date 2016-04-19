<p>
    A new delivery enquiry has been placed on <?=APP_NAME?>'s store for item listed below.
<p>
<p>
    Please find details below:
</p>
<table class="default-style">
    <tbody>
        <tr>
            <td class="left-header-cell">
                Product
            </td>
            <td>
                <strong>{{product.label}}</strong>
                <small>{{variant.label}} - {{variant.sku}}</small>
            </td>
        </tr>
        <tr>
            <td class="left-header-cell">
                Name
            </td>
            <td>
                {{customer.name}}
            </td>
        </tr>
        <tr>
            <td class="left-header-cell">
                Email
            </td>
            <td>
                {{customer.email}}
            </td>
        </tr>
        <tr>
            <td class="left-header-cell">
                Telephone
            </td>
            <td>
                {{customer.telephone}}
            </td>
        </tr>
        <tr>
            <td class="left-header-cell">
                Address
            </td>
            <td>
                {{customer.address}}
            </td>
        </tr>
        <tr>
            <td class="left-header-cell">
                Notes
            </td>
            <td>
                {{customer.notes}}
            </td>
        </tr>
    </tbody>
</table>