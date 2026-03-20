<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Atgādinājums par auto</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #374151; margin: 0; padding: 20px; background-color: #f9fafb;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 12px; shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        
        <h2 style="color: #2563eb; margin-top: 0;">Sveiki!</h2>
        
        <p>Vēlamies atgādināt, ka Jūsu automašīnai <strong>{{ $car->razotajs }} {{ $car->modelis }}</strong> tuvojas <strong>{{ $type }}</strong> termiņa beigas.</p>

        <div style="background-color: #fef2f2; padding: 20px; border-radius: 8px; border-left: 5px solid #ef4444; margin: 20px 0;">
            @if($type == 'Eļļas maiņa')
                <p style="margin: 0; font-weight: bold; color: #991b1b; font-size: 18px;">
                    Prognozējam, ka eļļas maiņa būs jāveic šomēnes!
                </p>
                <p style="margin: 10px 0 0 0; font-size: 15px; color: #4b5563;">
                    • Vēl vari nobraukt: <strong>{{ $extra['km_atlikusi'] ?? 0 }} km</strong><br>
                    • Līdz mēneša beigām: <strong>{{ $extra['dienas_beigas'] ?? 0 }} dienas</strong>
                </p>
            @else
                <p style="margin: 0; font-weight: bold; color: #991b1b; font-size: 18px;">
                    Termiņš beigsies pēc 
                    @if($days == 1) 1 dienas @else {{ $days }} dienām @endif
                </p>
            @endif
        </div>

        <p style="font-size: 14px; color: #6b7280;">Lūdzu, savlaicīgi veiciet nepieciešamās darbības, lai Jūsu auto būtu tehniskā kārtībā.</p>
        
        
    </div>
</body>
</html>