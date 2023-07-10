<form>
    <table>
      <tr>
        <th>Bestellnummer</th>
        <th>Bestelldatum</th>
        <th>Betrag</th>
      </tr>
      <tr>
        <td><?php echo $vars['orderdetails']['BESTELLNR']; ?></td>
        <td><?php echo $vars['orderdetails']['BESTELLDATUM']; ?></td>
        <td><?php echo $vars['orderdetails']['RECHNUNGSBETRAG']; ?></td>
      </tr>
    </table>
</form>
