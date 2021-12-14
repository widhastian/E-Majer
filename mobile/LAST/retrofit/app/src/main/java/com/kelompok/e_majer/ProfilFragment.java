package com.kelompok.e_majer;

import static com.kelompok.e_majer.SessionManager.KELAS;
import static com.kelompok.e_majer.SessionManager.NAME;
import static com.kelompok.e_majer.SessionManager.USERNAME;
import static com.kelompok.e_majer.SessionManager.USER_ID;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import androidx.fragment.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.HashMap;
import java.util.Map;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link ProfilFragment#newInstance} factory method to
 * create an instance of this fragment.
 *
 */
public class ProfilFragment extends Fragment {

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";
    String name;
    SessionManager sessionManager;
    SharedPreferences sp;

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;
    private Context thisContext;

    TextView txtNama;
    SessionManager SessionManager;


    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment ProfilFragment.
     */
    // TODO: Rename and change types and number of parameters
    public static ProfilFragment newInstance(String param1, String param2) {
        ProfilFragment fragment = new ProfilFragment();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }


    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
//        txtNama = (TextView) findViewById
//        View view = inflater.inflate(LayoutInflater inflater, View)
//        SharedPreferences sharedPreferences;
//        sharedPreferences = androidx.preference.PreferenceManager.getDefaultSharedPreferences(getActivity());
//        SharedPreferences sharedPreferences = getActivity().getSharedPreferences("NAME", Context.MODE_PRIVATE).;
//        System.out.println(sharedPreferences);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
//        thisContext = container.getContext();
//        sessionManager = new SessionManager();
//        SharedPreferences sharedPreferences = this.getActivity().getSharedPreferences("NAME", Context.MODE_PRIVATE);
//        TextView textView;
//        View view = inflater.inflate(R.layout.fragment_profil, container, false);
//        textView = (TextView) view.findViewById(R.id.etProfilName);
//        textView.setText();
//        System.out.println(sharedPreferences);
//        return view;
        return inflater.inflate(R.layout.fragment_profil, container, false);
    }

}