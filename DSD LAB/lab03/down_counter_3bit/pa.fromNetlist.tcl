
# PlanAhead Launch Script for Post-Synthesis pin planning, created by Project Navigator

create_project -name down_counter_3bit -dir "D:/Semester Data/6th semester/DSD LAB/lab03/down_counter_3bit/planAhead_run_1" -part xc6slx9csg324-2
set_property design_mode GateLvl [get_property srcset [current_run -impl]]
set_property edif_top_file "D:/Semester Data/6th semester/DSD LAB/lab03/down_counter_3bit/Top.ngc" [ get_property srcset [ current_run ] ]
add_files -norecurse { {D:/Semester Data/6th semester/DSD LAB/lab03/down_counter_3bit} }
set_param project.pinAheadLayout  yes
set_property target_constrs_file "Top.ucf" [current_fileset -constrset]
add_files [list {Top.ucf}] -fileset [get_property constrset [current_run]]
link_design
