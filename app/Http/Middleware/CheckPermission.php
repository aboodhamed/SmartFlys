<?php
namespace App\Http\Middleware;

use App\Models\Action;
use App\Models\Entity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $entity, $action)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect('/login');
        }

        // جيب الـ EntityID و ActionID بناءً على الأسماء
        $entityModel = Entity::where('EntityName', $entity)->first();
        $actionModel = Action::where('ActionName', $action)->first();

        if (!$entityModel || !$actionModel) {
            abort(403, 'Entity or Action does not exist.');
        }

        $entityId = $entityModel->EntityID;
        $actionId = $actionModel->ActionID;

        // تحقق إذا الـ Action مسموح للـ Entity أصلاً في entityactions
        $entityHasAction = $entityModel->actions()
            ->where('entityactions.ActionID', $actionId) // حددنا العمود مع الجدول entityactions
            ->exists();
        if (!$entityHasAction) {
            abort(403, 'This action is not allowed for this entity.');
        }

        // تحقق إذا اليوزر عنده الصلاحية في role_permissions
        if (!$user->hasPermission($entityId, $actionId)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}