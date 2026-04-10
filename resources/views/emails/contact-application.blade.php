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
        background: #B5622E;
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
    .subtitle {
        color: #6B5C52;
        margin-bottom: 2rem;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    th {
        background: #F5EFE6;
        color: #B5622E;
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
    .label-col {
        color: #6B5C52;
        font-size: 0.875rem;
        width: 140px;
    }
    .value-col {
        color: #3D3530;
        font-weight: 500;
    }
    .value-col-accent {
        color: #B5622E;
        font-weight: 500;
    }
    .note {
        margin-top: 2rem;
        padding-top: 1.5rem;
        color: #6B5C52;
        font-size: 0.8rem;
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
            <h1>📩 Nuovo messaggio di contatto</h1>
        </div>
        <div class="body">
            <p class="subtitle">
                Hai ricevuto un nuovo messaggio dal modulo contatti di Presto.it.
            </p>
            <table>
                <tr>
                    <td class="label-col">Nome</td>
                    <td class="value-col">{{ $userName }}</td>
                </tr>
                <tr>
                    <td class="label-col">Email</td>
                    <td class="value-col-accent">{{ $userEmail }}</td>
                </tr>
                <tr>
                    <td class="label-col" style="vertical-align: top;">Messaggio</td>
                    <td class="value-col">{{ $motivation }}</td>
                </tr>
            </table>
            <div class="note">
                <p>Puoi rispondere direttamente a questa email per metterti in contatto con l'utente.</p>
            </div>
            <a href="{{ route('homepage') }}" class="btn">Torna a Presto.it</a>
        </div>
        <div class="footer">
            © {{ date('Y') }} Presto.it — Tutti i diritti riservati.
        </div>
    </div>
</body>
</html>