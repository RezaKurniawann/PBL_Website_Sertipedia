public function show(User $user)
{
    return view('user.show', compact('user'));
}