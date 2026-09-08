<?php
namespace App\Http\Controllers;
use App\Models\DesaProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
class Controller extends BaseController { 
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests; 
    protected function desaId(): int { return (int)session('desa_id',1); } protected function desa(): DesaProfile { return DesaProfile::find($this->desaId()) ?? DesaProfile::firstOrCreate(['id'=>$this->desaId()], ['name'=>'Desa Cantik']); } protected function pdf(string $title,array $rows,string $filename){$lines=array_merge([$title,''],...array_map(fn($r)=>[($r[0]??'').': '.($r[1]??'')],$rows));$lines=array_slice($lines,0,48);$content="BT\n/F1 14 Tf\n50 760 Td\n";foreach($lines as $i=>$line){$safe=str_replace(['\\','(',')'],['\\\\','\\(','\\)'],strip_tags((string)$line));if($i===0){$content.="($safe) Tj\n";}else{$content.="0 -15 Td\n/F1 9 Tf\n($safe) Tj\n";}}$content.="ET";$objs=[];$objs[]='<< /Type /Catalog /Pages 2 0 R >>';$objs[]='<< /Type /Pages /Kids [3 0 R] /Count 1 >>';$objs[]='<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>';$objs[]='<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>';$objs[]="<< /Length ".strlen($content)." >>\nstream\n$content\nendstream";$pdf="%PDF-1.4\n";$offs=[];foreach($objs as $n=>$o){$offs[$n+1]=strlen($pdf);$pdf.=($n+1)." 0 obj\n$o\nendobj\n";}$xref=strlen($pdf);$pdf.="xref\n0 6\n0000000000 65535 f \n";for($i=1;$i<=5;$i++)$pdf.=sprintf('%010d 00000 n \n',$offs[$i]);$pdf.="trailer << /Size 6 /Root 1 0 R >>\nstartxref\n$xref\n%%EOF";return response($pdf,200,['Content-Type'=>'application/pdf','Content-Disposition'=>'attachment; filename="'.$filename.'"']);} }
