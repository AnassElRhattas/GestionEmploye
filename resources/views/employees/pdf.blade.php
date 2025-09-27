<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Employé - {{ $employee->prenom }} {{ $employee->nom }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4CAF50;
        }
        .header h1 {
            color: #2E7D32;
            margin-bottom: 5px;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }
        .status-available {
            background-color: #4CAF50;
            color: white;
        }
        .status-unavailable {
            background-color: #F44336;
            color: white;
        }
        .section {
            margin-bottom: 25px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
        }
        .section h2 {
            color: #2E7D32;
            margin-top: 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
        .info-value {
            margin-top: 3px;
        }
        .tag-container {
            margin-top: 10px;
        }
        .tag {
            display: inline-block;
            background-color: #E8F5E9;
            color: #2E7D32;
            padding: 4px 8px;
            border-radius: 4px;
            margin-right: 5px;
            margin-bottom: 5px;
            font-size: 12px;
            border: 1px solid #C8E6C9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Fiche Employé</h1>
        <p>Informations complètes sur l'employé</p>
        <div class="status {{ $employee->disponible ? 'status-available' : 'status-unavailable' }}">
            {{ $employee->disponible ? 'Disponible' : 'Non disponible' }}
        </div>
    </div>

    <div class="section">
        <h2>Informations personnelles</h2>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nom complet</div>
                <div class="info-value">{{ $employee->prenom }} {{ $employee->nom }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Âge</div>
                <div class="info-value">{{ $employee->age }} ans</div>
            </div>
            <div class="info-item">
                <div class="info-label">Zone rurale</div>
                <div class="info-value">{{ $employee->zone_rurale }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Expérience</div>
                <div class="info-value">{{ $employee->experience_annees }} ans</div>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Expérience par culture</h2>
        <div class="tag-container">
            @foreach(json_decode($employee->experience_cultures) as $culture)
                <span class="tag">{{ ucfirst($culture) }}</span>
            @endforeach
        </div>
    </div>

    <div class="section">
        <h2>Spécialités</h2>
        <ul>
            @foreach(json_decode($employee->specialites) as $specialite)
                <li>{{ $specialite }}</li>
            @endforeach
        </ul>
    </div>

    <div class="footer">
        <p>Document généré le {{ date('d/m/Y à H:i') }} | Plateforme de gestion des employés agricoles</p>
    </div>
</body>
</html>