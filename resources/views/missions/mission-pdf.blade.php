<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cahier de Charge - {{ $mission->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            color: #000;
            line-height: 1.5;
            margin: 0;
            padding: 30px 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 15px;
            border-bottom: 1px solid #000;
        }
        .header .title {
            font-size: 20pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .header .subtitle {
            font-size: 13pt;
            margin-bottom: 5px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 13pt;
            font-weight: bold;
            margin-bottom: 8px;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
        }
        .info-row {
            margin-bottom: 6px;
        }
        .label {
            display: inline-block;
            width: 160px;
            font-weight: bold;
        }
        .employee-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 8px;
            background-color: #fff;
        }
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 9pt;
            color: #555;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Cahier de Charge</div>
        <div class="subtitle">{{ $mission->title }}</div>
        <div>Date d'édition : {{ now()->format('d/m/Y') }}</div>
    </div>

    <div class="section">
        <div class="section-title">Informations générales</div>
        <div class="info-row">
            <span class="label">Titre de la mission :</span> {{ $mission->title }}
        </div>
        <div class="info-row">
            <span class="label">Entreprise :</span> {{ $mission->company }}
        </div>
        <div class="info-row">
            <span class="label">Statut :</span>
            <span class="status-badge">{{ $mission->status === 'en_cours' ? 'En cours' : 'Terminée' }}</span>
        </div>
        <div class="info-row">
            <span class="label">Période :</span>
            @if ($mission->duration_days)
                {{ $mission->duration_days }} jours
            @elseif($mission->start_date && $mission->end_date)
                Du {{ $mission->start_date->format('d/m/Y') }} au {{ $mission->end_date->format('d/m/Y') }}
            @else
                Non spécifiée
            @endif
        </div>
    </div>

    @if ($mission->notes)
    <div class="section">
        <div class="section-title">Description et objectifs</div>
        <p>{{ $mission->notes }}</p>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Ressources humaines assignées</div>
        @if ($mission->employees->isEmpty())
            <p>Aucun employé assigné à cette mission.</p>
        @else
            @foreach ($mission->employees as $employee)
                <div class="employee-card">
                    <div class="info-row">
                        <span class="label">Nom complet :</span>
                        {{ $employee->nom }} {{ $employee->prenom }}
                    </div>

                    @php
                        $specs = is_array($employee->specialites)
                            ? $employee->specialites
                            : json_decode($employee->specialites, true);
                    @endphp

                    @if (!empty($specs))
                        <div class="info-row">
                            <span class="label">Spécialités :</span>
                            {{ implode(', ', $specs) }}
                        </div>
                    @endif

                    @if ($employee->experience_annees)
                        <div class="info-row">
                            <span class="label">Expérience :</span>
                            {{ $employee->experience_annees }} ans
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <div class="footer">
        <p>Ce document est généré automatiquement et constitue le cahier de charge officiel pour la mission spécifiée.</p>
        <p>© {{ date('Y') }} - Plateforme de Gestion des Employés</p>
    </div>
</body>
</html>
