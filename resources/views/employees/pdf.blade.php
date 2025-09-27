<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fiche Employé - {{ $employee->prenom }} {{ $employee->nom }}</title>
  <style>
    body {
      font-family: 'Helvetica', 'Arial', sans-serif;
      font-size: 12px;
      line-height: 1.4;
      color: #000;
      margin: 0;
      padding: 15px;
    }

    .header {
      text-align: center;
      margin-bottom: 15px;
      padding-bottom: 6px;
      border-bottom: 1px solid #aaa;
    }
    .header h1 {
      font-size: 18px;
      margin: 0 0 3px 0;
      text-transform: uppercase;
    }
    .header p {
      font-size: 11px;
      margin: 0;
    }

    .status {
      display: inline-block;
      padding: 2px 6px;
      border-radius: 3px;
      font-weight: bold;
      font-size: 11px;
      margin-top: 6px;
      border: 1px solid #000;
    }

    .section {
      margin-bottom: 12px;
      padding: 8px 10px;
      border: 1px solid #ddd;
      border-radius: 3px;
    }

    .section h2 {
      font-size: 13px;
      margin: 0 0 5px 0;
      padding-bottom: 3px;
      border-bottom: 1px solid #ccc;
      text-transform: uppercase;
    }

    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
    }

    .info-item {
      margin-bottom: 4px;
    }

    .info-label {
      font-weight: bold;
    }
    .info-value {
      margin-top: 1px;
    }

    .tag-container {
      margin-top: 5px;
    }

    .tag {
      display: inline-block;
      border: 1px solid #999;
      padding: 2px 5px;
      border-radius: 3px;
      margin-right: 3px;
      margin-bottom: 3px;
      font-size: 11px;
    }

    ul {
      padding-left: 16px;
      margin: 0;
    }

    .footer {
      margin-top: 15px;
      text-align: center;
      font-size: 10px;
      color: #555;
      border-top: 1px solid #aaa;
      padding-top: 5px;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>Fiche Employé</h1>
    <p>Informations complètes sur l'employé</p>
    <div class="status">
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
    Document généré le {{ date('d/m/Y à H:i') }} | Plateforme de gestion des employés agricoles
  </div>
</body>
</html>
