package com.kelompok.e_majer;

import android.content.Context;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;


import com.kelompok.e_majer.model.login.LoginData;
import com.kelompok.e_majer.model.register.RegisterData;

import java.util.HashMap;

public class SessionManager {

    private Context _context;
    private SharedPreferences sharedPreferences;
    private SharedPreferences.Editor editor;

    public static final String IS_LOGGED_IN = "isLoggedIn";
    public static final String USER_ID = "user_id";
    public static final String USERNAME = "username";
    public static final String NAME = "nama";
    public static final String KELAS = "kelas";
    public static final String EMAIL = "email";
    public static final String PASSWORD = "password";
    public static final String SALDO = "saldo";

    private final String INTRO = "intro";

    public SessionManager(Context context){
        this._context = context;
        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(context);
        editor = sharedPreferences.edit();
    }

    public void createLoginSession(LoginData user){
        editor.putBoolean(IS_LOGGED_IN, true);
        editor.putString(USER_ID, user.getUserId());
        editor.putString(USERNAME, user.getUsername());
        editor.putString(NAME, user.getName());
        editor.putString(KELAS, user.getKelas());
        editor.putString(EMAIL, user.getEmail());
        editor.putString(PASSWORD, user.getPassword());
        editor.putString(SALDO, user.getSaldo());
//        System.out.println(user.getName());
        editor.commit();
    }

    public void createRegisterSession(RegisterData user){
        editor.putBoolean(IS_LOGGED_IN, true);
        editor.putString(USER_ID, user.getUserId());
        editor.putString(USERNAME, user.getUsername());
        editor.putString(NAME, user.getName());
        editor.putString(KELAS, user.getKelas());
        editor.putString(EMAIL, user.getEmail());
        editor.putString(PASSWORD, user.getPassword());
        editor.putString(SALDO, user.getSaldo());
//        System.out.println(user.getName());
        editor.commit();
    }

    public HashMap<String,String> getUserDetail(){
        HashMap<String,String> user = new HashMap<>();
        user.put(USER_ID, sharedPreferences.getString(USER_ID, null));
        user.put(USERNAME, sharedPreferences.getString(USERNAME,null));
        user.put(NAME, sharedPreferences.getString(NAME,null));
        user.put(KELAS, sharedPreferences.getString(KELAS,null));
        user.put(EMAIL, sharedPreferences.getString(EMAIL,null));
        user.put(PASSWORD, sharedPreferences.getString(PASSWORD,null));
        user.put(SALDO, sharedPreferences.getString(SALDO,null));
        return user;
    }

    public void putIsLoggin(boolean isloggedin){
        SharedPreferences.Editor edit = sharedPreferences.edit();
        edit.putBoolean(INTRO, isloggedin);
        edit.commit();
    }

    public void logoutSession(){
        editor.clear();
        editor.commit();
    }

    public boolean isLoggedIn(){
        return sharedPreferences.getBoolean(IS_LOGGED_IN, false);
    }

    public void setUserId(String isLoggedin){
        SharedPreferences.Editor edit = sharedPreferences.edit();
        edit.putString(USER_ID, isLoggedin);
        edit.commit();
    }

    public void setName(String isLoggedin){
        SharedPreferences.Editor edit = sharedPreferences.edit();
        edit.putString(NAME, isLoggedin);
        edit.commit();
    }

    public void setKelas(String isLoggedin){
        SharedPreferences.Editor edit = sharedPreferences.edit();
        edit.putString(KELAS, isLoggedin);
        edit.commit();
    }

    public void setEmail(String isLoggedin){
        SharedPreferences.Editor edit = sharedPreferences.edit();
        edit.putString(EMAIL, isLoggedin);
        edit.commit();
    }

    public void setUsername(String isLoggedin){
        SharedPreferences.Editor edit = sharedPreferences.edit();
        edit.putString(USERNAME, isLoggedin);
        edit.commit();
    }

    public void setPassword(String isLoggedin){
        SharedPreferences.Editor edit = sharedPreferences.edit();
        edit.putString(PASSWORD, isLoggedin);
        edit.commit();
    }

    public void setSaldo(String isLoggedin){
        SharedPreferences.Editor edit = sharedPreferences.edit();
        edit.putString(SALDO, isLoggedin);
        edit.commit();
    }

    public String getUserId(){ return sharedPreferences.getString(USER_ID, ""); }
    public String getName(){ return sharedPreferences.getString(NAME, ""); }
    public String getKelas(){ return sharedPreferences.getString(KELAS, ""); }
    public String getEmail(){ return sharedPreferences.getString(EMAIL, ""); }
    public String getUsername(){ return sharedPreferences.getString(USERNAME, ""); }
    public String getPassword(){ return sharedPreferences.getString(PASSWORD, ""); }
    public String getSaldo(){ return sharedPreferences.getString(SALDO, ""); }


}

