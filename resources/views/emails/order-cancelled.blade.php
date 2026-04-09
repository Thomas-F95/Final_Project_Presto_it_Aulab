<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #F9F6F0;
            color: #3D3530;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #E8D5B7;
        }

        .header {
            background: #C0392B;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            color: #fff;
            font-size: 1.8rem;
            margin: 0;
        }

        .body {
            padding: 30px;
        }

        .greeting {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th {
            background: #F5EFE6;
            color: #C0392B;
            padding: 10px;
            text-align: left;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #E8D5B7;
            font-size: 0.95rem;
        }

        .total-row td {
            font-weight: bold;
            font-size: 1.05rem;
            border-bottom: none;
        }

        .footer {
            background: #3D3530;
            color: #E8D5B7;
            text-align: center;
            padding: 20px;
            font-size: 0.8rem;
        }

        .btn {
            display: inline-block;
            background: #B5622E;
            color: #fff;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>❌ Ordine Annullato</h1>
        </div>
        <div class="body">
            <p class="greeting">Ciao <strong>{{ $userName }}</strong>,</p>
            <p>Il tuo ordine su <strong>Presto.it</strong> è stato annullato. Se non hai annullato tu, puoi riprovare il
                pagamento.</p>

            <table>
                <thead>
                    <tr>
                        <th>Articolo</th>
                        <th>Prezzo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['title'] }}</td>
                            <td>€ {{ number_format($item['price'], 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>Totale</td>
                        <td>€ {{ number_format($total, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ route('cart.checkout') }}" class="btn">Riprova il pagamento</a>
        </div>
        <div class="footer">
            © {{ date('Y') }} Presto.it — Tutti i diritti riservati.
        </div>
    </div>
</body>

</html>
