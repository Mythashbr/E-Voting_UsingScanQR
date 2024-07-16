namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyClientCertificate
{
    public function handle(Request $request, Closure $next)
    {
        $clientCert = $request->header('X-Client-Cert');

        if ($clientCert) {
            // Lakukan verifikasi tambahan jika perlu, misalnya memeriksa DN
            // $dn = openssl_x509_parse($clientCert);

            // Contoh sederhana: hanya mengizinkan jika sertifikat ada
            if ($this->verifyCertificate($clientCert)) {
                // Sertifikat valid, lanjutkan request
                return $next($request);
            }
        }

        // Sertifikat tidak valid atau tidak ada, tolak request
        return response('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }

    protected function verifyCertificate($cert)
    {
        // Tambahkan logika verifikasi sertifikat Anda di sini
        return true; // Sementara, anggap sertifikat selalu valid
    }
}
